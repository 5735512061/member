@extends('frontend/layouts/template')
<style>
    .centered {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: red;
        font-weight: bold;
    }
</style>
@section('content')
    <div class="container" style="margin-bottom: 50px;">
        <center>
            <div class="header-title">
                <h2 style="margin-top:10rem;">
                    <strong>คูปองของฉัน</strong>
                </h2>
            </div>
        </center>
        <br>
    </div>
    <div class="container mb-100">
        <div class="row">
            @foreach ($coupons as $coupon => $value)
                @php
                    $dateNow = Carbon\Carbon::now()->format('Y-m-d');
                    $image = DB::table('campaigns')
                        ->where('id', $value->coupon_id)
                        ->value('image');
                    $expire_date = DB::table('campaigns')
                        ->where('id', $value->coupon_id)
                        ->value('expire_date');
                    $expire_date_format = date('d/m/Y', strtotime($expire_date));
                    $name = DB::table('campaigns')
                        ->where('id', $value->coupon_id)
                        ->value('name');
                    $detail = DB::table('campaigns')
                        ->where('id', $value->coupon_id)
                        ->value('detail');
                    $partner_id = DB::table('campaigns')
                        ->where('id', $value->coupon_id)
                        ->value('partner_id');
                    $partner = DB::table('partner_shops')
                        ->where('id', $partner_id)
                        ->value('name');
                @endphp
                <div class="col-lg-4 col-md-6">
                    @if ($value->status == 'ยังไม่ใช้งาน')
                        <div class="single-latest-news" style="background-color: #ffffff;">
                            <a href="{{ url('privilege') }}/{{ $value->coupon_id }}/{{ $name }}">
                                <img src="{{ url('images/campaign') }}/{{ $image }}"
                                    class="latest-news-bg img-responsive" width="100%">
                            </a>
                            <div class="news-text-box">
                                <h1><a
                                        href="{{ url('privilege') }}/{{ $value->coupon_id }}/{{ $name }}">{{ $name }}</a>
                                </h1>
                                <p class="mt-3">ใช้คูปองได้ที่ <i class="fa fa-caret-right"></i> {{ $partner }}</p>
                                <p style="color:rgb(0, 0, 0); margin-top:-15px !important;"><strong>กดรับคูปองวันที่ <i
                                            class="fa fa-caret-right" style="color:#000000;"></i>
                                        {{ $value->date_get_coupon }}</strong></p>
                                <div style="border-bottom: 2px dashed #cac8c8;"></div>
                                <div class="flex space-between mt-3">
                                    <p class="blog-meta">
                                        @php
                                            $expire_date_format = date('d-m-Y', strtotime($expire_date));
                                        @endphp
                                        <strong style="color: red;">สิ้นสุดแคมเปญ {{ $expire_date_format }}</strong>
                                    </p>
                                    <a href="{{ url('privilege') }}/{{ $value->coupon_id }}/{{ $name }}"
                                        style="text-align:end;">รายละเอียดเพิ่มเติม
                                        <i class="fa fa-caret-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @elseif($value->status == 'ใช้งานแล้ว')
                        <div class="single-latest-news" style="background-color: #ffffff; opacity:0.4;">
                            <a href="#">
                                <img src="{{ url('images/campaign') }}/{{ $image }}"
                                    class="img-responsive" width="100%">
                            </a>
                            <div class="news-text-box">
                                <h1><a href="#">{{ $name }}</a>
                                </h1>
                                <p class="mt-3">ใช้คูปองได้ที่ <i class="fa fa-caret-right"></i> {{ $partner }}</p>
                                <p style="color:rgb(0, 0, 0); margin-top:-15px !important;"><strong>กดรับคูปองวันที่ <i
                                            class="fa fa-caret-right" style="color:#000000;"></i>
                                        {{ $value->date_get_coupon }}</strong></p>
                                <div style="border-bottom: 2px dashed #cac8c8;"></div>
                                <div class="flex space-between mt-3">
                                    <p class="blog-meta">
                                        @php
                                            $expire_date_format = date('d-m-Y', strtotime($expire_date));
                                        @endphp
                                        <strong style="color: red;">สิ้นสุดแคมเปญ {{ $expire_date_format }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="centered">คูปองใช้งานแล้ว<br>วันที่ {{ $value->date_use_coupon }}</div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
