@extends('backend/layouts/admin/template')
<style>
    .member-profile a {
        color: #ffffff;
    }

    .member-profile a:hover {
        color: #ffffff;
    }

    .vertical-center {
        margin: 0;
        position: absolute;
        top: 50%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
    }

    .card span {
        font-size: 30px;
        color: red;
        font-weight: bold;
    }

    .card-header a {
        color: #1300c2;
    }

    .card-header a:hover {
        color: #471de0;
    }
</style>
@section('content')
    @php
        $sumprice = DB::table('points')
            ->where('member_id', $member->id)
            ->sum('price');
        $culPrice = floor($sumprice / 100);

        // หักคะแนนจากการแลกของรางวัล
        $redeem_reward_point = DB::table('redeem_rewards')
            ->join('reward_points', 'reward_points.id', '=', 'redeem_rewards.point_id')
            ->where('member_id', $member->id)
            ->sum('reward_points.point');

        // หักคะแนนแลกสิทธิ์ร้านค้าพันธมิตร
        $redeem_point = DB::table('redeem_points')
            ->join('partner_shop_points', 'partner_shop_points.id', '=', 'redeem_points.point_id')
            ->where('member_id', $member->id)
            ->sum('partner_shop_points.point');

        $point_balance = $culPrice - $redeem_reward_point - $redeem_point;
    @endphp
    <div class="container-fluid py-4">
        <div class="member-profile">
            <div class="row">
                <div class="col-lg-5 mb-lg-0 mb-4">
                    <a href="javascript:history.back();"><i class="ni ni-bold-left"></i> ย้อนกลับ</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8 mt-4 mb-lg-0 mb-4">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if (Session::has('alert-' . $msg))
                            <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                        @endif
                    @endforeach
                    <div class="card z-index-2">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <a href="{{ url('editProfile') }}/{{ $member->id }}"><i class="ni ni-settings"
                                            aria-hidden="true"></i> แก้ไขข้อมูล</a>
                                </div>
                                <div class="col-md-4">
                                    <center><img src="{{ url('assets/image/profile.png') }}" width="70%;"></center>
                                </div>
                                @php
                                    $member_new = count(
                                        DB::table('members')
                                            ->where('id', $member->id)
                                            ->where(
                                                'created_at',
                                                '>',
                                                now()
                                                    ->subDays(30)
                                                    ->endOfDay(),
                                            )
                                            ->get(),
                                    );
                                    // min_price, max_price ระดับสมาชิก
                                    $min_price_standard = DB::table('tiers')
                                        ->where('tier', 'STANDARD')
                                        ->value('min_price');
                                    $max_price_standard = DB::table('tiers')
                                        ->where('tier', 'STANDARD')
                                        ->value('max_price');
                                    $min_price_premium = DB::table('tiers')
                                        ->where('tier', 'PREMIUM')
                                        ->value('min_price');
                                    $max_price_premium = DB::table('tiers')
                                        ->where('tier', 'PREMIUM')
                                        ->value('max_price');
                                    $min_price_supreme = DB::table('tiers')
                                        ->where('tier', 'SUPREME')
                                        ->value('min_price');
                                @endphp
                                <div class="col-md-4" style="border-right: 2px dashed #9e9e9e;">

                                    @if ($member->status == 'ONLINE')
                                        <button class="btn btn-success btn-sm my-auto" style="color:#fff;">
                                            {{ $member->status }}
                                        </button>
                                    @else
                                        <button class="btn btn-danger btn-sm my-auto" style="color:#fff;">
                                            {{ $member->status }}
                                        </button>
                                    @endif
                                    @if ($member_new != 0)
                                        <button class="btn btn-warning btn-sm my-auto"
                                            style="color:#fff;">ลูกค้าใหม่</button>
                                    @endif
                                    <h5 class="mt-2">หมายเลขสมาชิก <i class="fa fa-caret-down"
                                            style="color:#777777;"></i><br>{{ $member->serialnumber }}</h5>
                                    <h5 class="mt-2">หมายเลขบัตรประชาชน <i class="fa fa-caret-down"
                                            style="color:#777777;"></i>
                                        <h5>
                                            @if ($member->card_id == null)
                                                <a
                                                    href="{{ url('editProfile') }}/{{ $member->id }}">ใส่หมายเลขบัตรประชาชน</a>
                                            @else
                                                <h5>{{ $member->card_id }}</h5>
                                            @endif

                                            <h4>คุณ{{ $member->name }} {{ $member->surname }}</h4>
                                </div>
                                <div class="col-md-4">
                                    @if ($sumprice == $min_price_standard || $sumprice < $max_price_standard)
                                        <h5 class="mt-3">ระดับของสมาชิก <i class="fa fa-caret-down"
                                                style="color:#777777;"></i><br>STANDARD</h5>
                                    @elseif($sumprice == $min_price_premium || $sumprice < $max_price_premium)
                                        <h5 class="mt-3">ระดับของสมาชิก <i class="fa fa-caret-down"
                                                style="color:#777777;"></i><br>PREMIUM</h5>
                                    @elseif($sumprice > $min_price_supreme)
                                        <h5 class="mt-3">ระดับของสมาชิก <i class="fa fa-caret-down"
                                                style="color:#777777;"></i><br>SUPREME</h5>
                                    @endif
                                    <h4 class="mb-1">พอยท์คงเหลือ <i class="fa fa-caret-down"
                                            style="color:#777777;"></i><br><span> {{ $point_balance }} </span>พอยท์</h4>
                                    <h5 class="mb-1">เบอร์โทรศัพท์ <i class="fa fa-caret-right"
                                            style="color:#777777;"></i> {{ $member->tel }}</h5>
                                    <h5>วัน/เดือน/ปีเกิด <i class="fa fa-caret-right" style="color:#777777;"></i>
                                        {{ $member->bday }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>

            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8 mt-4 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <div class="table-responsive">
                                <table class="table align-items-center">
                                    <thead class="thead-light">
                                        <tr style="text-align: center;">
                                            <th>ลำดับ</th>
                                            <th>วันที่</th>
                                            <th>สาขา</th>
                                            <th>หมายเลขบิล</th>
                                            <th>จำนวนเงิน</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach ($points as $point => $value)
                                            @php
                                                $store_name = DB::table('account_stores')
                                                    ->where('id', $value->branch_id)
                                                    ->value('store_name');
                                                $branch = DB::table('account_stores')
                                                    ->where('id', $value->branch_id)
                                                    ->value('branch');
                                            @endphp
                                            <tr style="text-align:center;">
                                                <td>{{ $NUM_PAGE * ($page - 1) + $point + 1 }}</td>
                                                <td>{{ $value->date }}</td>
                                                <td>{{ $store_name }} {{ $branch }}</td>
                                                <td>{{ $value->bill_number }}</td>
                                                <td>{{ $value->price }}</td>
                                                <td>
                                                    <a data-bs-toggle="modal" data-bs-target="#editPoint"
                                                        data-bs-toggle="modal" data-bs-target="#editPoint"
                                                        class="mt-2 btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto">
                                                        <i class="ni ni-settings" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <!-- Modal -->
                                            <div class="modal fade" id="editPoint" data-bs-backdrop="static" tabindex="-1">
                                                <div class="modal-dialog modal-content">
                                                    <form action="{{ url('editPoint') }}" method="POST"
                                                        enctype="multipart/form-data" class="">@csrf
                                                        <input type="hidden" name="id" value="{{ $value->id }}">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editPointTitle">แก้ไขบิล</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12 mb-3">
                                                                    <label class="form-label">หมายเลขรายการ</label>
                                                                    <input type="text" name="bill_number"
                                                                        class="form-control"
                                                                        value="{{ $value->bill_number }}" />
                                                                </div>
                                                                <div class="col-md-12 mb-3">
                                                                    <label class="form-label">จำนวนเงิน
                                                                        (ไม่ต้องใส่เครื่องหมาย ใส่แค่ตัวเลข)
                                                                    </label>
                                                                    <input type="text" name="price"
                                                                        class="form-control"
                                                                        value="{{ $value->price }}" />
                                                                </div>
                                                                <div class="col-md-12 mb-3">
                                                                    @php
                                                                        $branchs = DB::table('account_stores')->get();
                                                                    @endphp
                                                                    <label class="form-label">สาขา</label>
                                                                    <select name="branch_id" class="form-control">
                                                                        <option value="{{ $value->branch_id }}">
                                                                            {{ $store_name }} สาขา{{ $branch }}
                                                                        </option>
                                                                        @foreach ($branchs as $branch => $value)
                                                                            <option value="{{ $value->id }}">
                                                                                {{ $value->store_name }}
                                                                                สาขา{{ $value->branch }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal"
                                                                style="font-family:'Noto Sans Thai';">ปิด</button>
                                                            <button type="submit" class="btn btn-primary"
                                                                style="font-family:'Noto Sans Thai';">แก้ไขบิล</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>
@endsection
