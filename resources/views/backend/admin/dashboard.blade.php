@extends('backend/layouts/admin/template')
<style>
    .repeat-member .member-types {
        display: flex;
        flex-direction: row;
        flex: 1;
        flex-wrap: wrap;
    }

    .repeat-member .member-types>div:first-child {
        background: #e6fcfc;
    }

    .repeat-member .member-types>div {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-width: 150px;
        padding: 20px 10px;
        border-radius: 16px;
        margin: 5px;
        box-shadow: 4px 4px 4px #f8f8f8;
    }

    .card>hr {
        margin-right: 20px !important;
        margin-left: 20px !important;
        border-bottom: 2px solid #d6d1d1;
    }

    .member-types p {
        font-weight: bolder;
        font-size: 18px;
    }

    .member-types span {
        font-weight: bolder;
        font-size: 18px;
    }

    .repeat-member p {
        font-weight: bolder;
        font-size: 18px;
    }

    .header h4 {
        color: #fff;
        border-bottom: 2px solid #eeeeee;
        padding-bottom: 15px;
    }
</style>
@section('content')
    @php
        $date_now = Carbon\Carbon::now();
        $count_member = number_format(DB::table('members')->count());
    @endphp
    <div class="container-fluid py-4">
        <div class="header">
            <h4>ภาพรวม (Dashboard)</h4>
        </div>
        <div class="row mt-4">
            <div class="col-lg-4 col-12 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <center>
                            <h6 class="text-capitalize">จำนวนสมาชิก <br>( {{ $count_member }} คน )</h6><br>
                        </center>
                        <center>
                            <div id="piechart" style="width: 450px; height: 320px; margin-top:-2rem;"></div>
                        </center>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-12 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">สถิติของสมาชิก</h6>
                    </div>
                    @php
                        $member_new = count(
                            DB::table('members')
                                ->where(
                                    'created_at',
                                    '>',
                                    now()
                                        ->subDays(30)
                                        ->endOfDay(),
                                )
                                ->get(),
                        );
                        $member_use_service = count(
                            DB::table('points')
                                ->groupBy('member_id')
                                ->get(),
                        );
                        $member_use_point = count(
                            DB::table('redeem_points')
                                ->groupBy('member_id')
                                ->get(),
                        );
                    @endphp
                    <div class="card-body p-3 repeat-member">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="member-types">
                                    <div class="text-sm mb-0" style="text-align:center;"><br>
                                        <span class="font-weight-bold">สมาชิกใหม่</span>
                                        <p style="text-align:center;">{{ $member_new }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="member-types">
                                    <div class="text-sm mb-0" style="background-color: #eef3ff; text-align:center;"><br>
                                        <span class="font-weight-bold">สมาชิกที่เข้าใช้บริการ</span>
                                        <p style="text-align:center;">{{ $member_use_service }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="member-types">
                                    <div class="text-sm mb-0" style="background-color: #f0e7fe; text-align:center;"><br>
                                        <span class="font-weight-bold">สมาชิกใช้สิทธิ์เครือข่ายพันธมิตร</span>
                                        <p style="text-align:center;">{{ $member_use_point }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $redeem_reward = count(
                    DB::table('redeem_rewards')
                        ->where('status', 'แลกรางวัลสำเร็จ')
                        ->get(),
                );

                $coupon = count(DB::table('get_coupons')->get());

                $get_coupon = count(
                    DB::table('get_coupons')
                        ->where('status', 'ใช้งานแล้ว')
                        ->get(),
                );
            @endphp
            <div class="col-lg-4 col-12 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <center>
                            <h6 class="text-capitalize">แลกของรางวัล</h6>
                        </center>
                    </div>
                    <div class="card-body p-3 repeat-member" style="text-align:center;">
                        <h3>{{ $redeem_reward }}</h3>
                        <p>ครั้ง</p>
                        <a href="{{ url('redeem-reward') }}" class="btn btn-info btn-sm">ตรวจสอบการแลกของรางวัล</a>
                    </div>
                    <div class="card-body p-3 repeat-member">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="member-types">
                                    <div class="text-sm mb-0" style="text-align:center;"><br>
                                        <span class="font-weight-bold">กดรับคูปอง</span>
                                        <p style="text-align:center;">{{ $coupon }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="member-types">
                                    <div class="text-sm mb-0" style="background-color: #eef3ff; text-align:center;"><br>
                                        <span class="font-weight-bold">ใช้คูปอง</span>
                                        <p style="text-align:center;">{{ $get_coupon }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div style="text-align: right;">
                    <a href="{{ route('export-member') }}" class="btn btn-md btn-success"><i class="fa fa-download"></i>
                        EXPORT
                        EXCEL</a>
                </div>
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">รายชื่อสมาชิก (ข้อมูลทั้งหมด)</h6>
                        {{-- <p>{{ $members->links() }}</p> --}}
                        {!! $members->appends(\Request::except('page'))->render() !!}
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table align-items-center">
                                <thead class="thead-light">
                                    <tr style="text-align: center;">
                                        <th>@sortablelink('id', ' ลำดับ')</th>
                                        <th>@sortablelink('serialnumber', ' หมายเลขสมาชิก')</th>
                                        <th>@sortablelink('tel', ' เบอร์โทร')</th>
                                        <th>@sortablelink('name', ' ชื่อ-นามสกุล')</th>
                                        <th>@sortablelink(' พอยท์')</th>
                                        <th>@sortablelink(' ระดับสมาชิก')</th>
                                        <th>@sortablelink('date', ' วันที่สมัคร')</th>
                                        <th>@sortablelink('status', ' สถานะ')</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @if ($members->count())
                                        @foreach ($members as $member => $value)
                                            @php
                                                // point ที่ได้รับ
                                                $sumprice = DB::table('points')
                                                    ->where('member_id', $value->id)
                                                    ->sum('price'); // ยอดจ่ายคิดระดับสมาชิก
                                                $culPrice = floor($sumprice / 100);

                                                // หักคะแนนจากการแลกของรางวัล
                                                $redeem_reward_point = DB::table('redeem_rewards')
                                                    ->join('reward_points', 'reward_points.id', '=', 'redeem_rewards.point_id')
                                                    ->where('member_id', $value->id)
                                                    ->sum('reward_points.point');

                                                // หักคะแนนแลกสิทธิ์ร้านค้าพันธมิตร
                                                $redeem_point = DB::table('redeem_points')
                                                    ->join('partner_shop_points', 'partner_shop_points.id', '=', 'redeem_points.point_id')
                                                    ->where('member_id', $value->id)
                                                    ->sum('partner_shop_points.point');

                                                $point_balance = $culPrice - $redeem_reward_point - $redeem_point;

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
                                            <tr style="text-align:center;">
                                                <td>{{ $NUM_PAGE * ($page - 1) + $member + 1 }}</td>
                                                <td>{{ $value->serialnumber }}</td>
                                                <td>{{ $value->tel }}</td>
                                                <td>{{ $value->name }} {{ $value->surname }}</td>
                                                <td>{{ $point_balance }}</td>
                                                @if ($sumprice == $min_price_standard || $sumprice < $max_price_standard)
                                                    <td>STANDARD</td>
                                                @elseif($sumprice == $min_price_premium || $sumprice < $max_price_premium)
                                                    <td>PREMIUM</td>
                                                @elseif($sumprice > $min_price_supreme)
                                                    <td>SUPREME</td>
                                                @endif
                                                <td>{{ $value->date }}</td>
                                                @if ($value->status == 'ONLINE')
                                                    <td>
                                                        <button class="btn btn-success btn-sm my-auto" style="color:#fff;">
                                                            {{ $value->status }}
                                                        </button>
                                                    </td>
                                                @else
                                                    <td>
                                                        <button class="btn btn-danger btn-sm my-auto" style="color:#fff;">
                                                            {{ $value->status }}
                                                        </button>
                                                    </td>
                                                @endif
                                                <td>
                                                    <a href="{{ url('member/profile') }}/{{ $value->id }}"
                                                        class="mt-2 btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                                            class="ni ni-bold-right" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        // Load google charts
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        // Draw the chart and set the chart values
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Tire Member', 'Member Count'],
                <?php echo $data_tier; ?>
            ]);

            var options = {
                is3D: true,
            };

            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
@endsection
