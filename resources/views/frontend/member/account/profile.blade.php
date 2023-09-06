@extends('frontend/layouts/template')
<style>
    @media only screen and (max-width: 768px) {
        #mobile {
            display: inline !important;
            padding: 5px;
        }

        #desktop {
            display: none;
        }
    }
    .card-profile h5{
        color: #777777;
    }

    .card-profile h4{
        color: #777777;
    }

    .card-profile h3{
        color: #777777;
    }
</style>
@section('content')
    @php
        $sumprice = DB::table('points')
            ->where('member_id', $member->id)
            ->sum('price');
        $point_balance = floor($sumprice / 100);
    @endphp
    <div class="container " id="desktop" style="margin-top: 15rem;">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card z-index-2">
                    <div class="card-header pb-0 pt-3 bg-transparent card-profile">
                        <div class="row mb-4 mt-4">
                            <div class="col-md-2">
                                <center><img src="{{ url('assets/image/profile.png') }}" width="100%;"></center>
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
                            @endphp
                            <div class="col-md-5" style="border-right: 2px dashed #9e9e9e;">

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
                                    <button class="btn btn-warning btn-sm my-auto" style="color:#fff;">ลูกค้าใหม่</button>
                                @endif
                                <h5 class="mt-2">หมายเลขสมาชิก <i class="fa fa-caret-down"
                                        style="color:#777777;"></i><br>{{ $member->serialnumber }}</h5>
                                <h4>คุณ{{ $member->name }} {{ $member->surname }}</h4>
                            </div>
                            <div class="col-md-5">
                                <h4 class="mb-1">พอยท์คงเหลือ <i class="fa fa-caret-down"
                                        style="color:#777777;"></i><br><span
                                        style="font-size:22px;">{{ $point_balance }}</span> พอยท์</h4>
                                <h5 class="mb-1">เบอร์โทรศัพท์ <i class="fa fa-caret-right" style="color:#777777;"></i>
                                    {{ $member->tel }}</h5>
                                <h5>วัน/เดือน/ปีเกิด <i class="fa fa-caret-right" style="color:#777777;"></i>
                                    {{ $member->bday }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

    <div class="container card-profile" id="mobile" style="display:none;">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card z-index-2">
                    <div class="card-header pb-0 pt-3 bg-transparent card-profile">
                        <div class="row mb-4 mt-4">

                            <div class="col-md-12">
                                <center><img src="{{ url('assets/image/profile.png') }}" width="40%;"></center>
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
                            @endphp
                            <div class="col-md-5">

                                @if ($member->status == 'ONLINE')
                                    <center><button class="btn btn-success btn-sm"
                                            style="color:#fff; margin-top:10px;">{{ $member->status }}</button></center>
                                @else
                                    <center><button class="btn btn-danger btn-sm my-auto"
                                            style="color:#fff;">{{ $member->status }}</button></center>
                                @endif

                                @if ($member_new != 0)
                                    <button class="btn btn-warning btn-sm my-auto" style="color:#fff;">ลูกค้าใหม่</button>
                                @endif
                                <div class="container" style="text-align: center;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="mt-2">หมายเลขสมาชิก <i class="fa fa-caret-down"
                                                    style="color:#777777;"></i><br>{{ $member->serialnumber }}</h5>
                                            <h3>คุณ{{ $member->name }} {{ $member->surname }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="container mt-3" style="text-align: center;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 class="mb-1">พอยท์คงเหลือ <i class="fa fa-caret-right"
                                                    style="color:#777777;"></i><span style="font-size:22px;">
                                                    {{ $point_balance }}</span> พอยท์</h4>
                                            <h5 class="mb-1">เบอร์โทรศัพท์ <i class="fa fa-caret-right"
                                                    style="color:#777777;"></i> {{ $member->tel }}</h5>
                                            <h5>วัน/เดือน/ปีเกิด <i class="fa fa-caret-right" style="color:#777777;"></i>
                                                {{ $member->bday }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    {{--  --}}
    <div class="container" style="text-align: center; margin-bottom:10rem;">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4 col-6">
                        <a href="{{ url('member/coupon') }}">
                            <div class="card mt-3">
                                <div class="card-body" style="padding: 1.25rem 0 1.25rem 0;">
                                    <p>คูปองของฉัน</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-6">
                        <a href="{{ url('member/profile-change') }}">
                            <div class="card mt-3">
                                <div class="card-body" style="padding: 1.25rem 0 1.25rem 0;">
                                    <p>แก้ไขข้อมูลส่วนตัว</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-6">
                        <a href="{{ url('member/redeem-point') }}">
                            <div class="card mt-3">
                                <div class="card-body" style="padding: 1.25rem 0 1.25rem 0;">
                                    <p>ประวัติการแลกพอยท์</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-6">
                        <a href="{{ url('member/tel-change') }}">
                            <div class="card mt-3">
                                <div class="card-body" style="padding: 1.25rem 0 1.25rem 0;">
                                    <p>เปลี่ยนเบอร์โทรศัพท์</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-6">
                        <a href="{{ route('password.change') }}">
                            <div class="card mt-3">
                                <div class="card-body" style="padding: 1.25rem 0 1.25rem 0;">
                                    <p>เปลี่ยนรหัสผ่าน</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-6">
                        <a href="{{ route('member.logout') }}"
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <div class="card mt-3">
                                <div class="card-body" style="padding: 1.25rem 0 1.25rem 0;">
                                    <p>ออกจากระบบ</p>
                                </div>
                            </div>
                        </a>
                        <form id="logout-form" action="{{ route('member.logout') }}" method="POST"
                            style="display: none;">@csrf</form>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection
