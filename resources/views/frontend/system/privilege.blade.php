@extends('frontend/layouts/template')
<style>
    .privilege .coupon h5 {
        color: #777777;
    }

    .privilege .coupon i {
        color: #777777;
        font-size: 16px;
    }
</style>
@section('content')
    <div class="container" style="margin-bottom: 50px;">
        <div class="header-title">
            <h2 style="padding-top: 5rem;">
                <strong>สิทธิประโยชน์พิเศษ</strong>
            </h2>
            <div style="display: flex; justify-content: space-between;">
                <h4>กดรับคูปองส่วนลดพิเศษในเครือพันธมิตร</h4>
            </div>
        </div>
        <div class="latest-news mb-100" style="margin-top: 50px;">
            <div class="row">
                @foreach ($coupons as $coupon => $value)
                    @php
                        $partner = DB::table('partner_shops')
                            ->where('id', $value->partner_id)
                            ->value('name');
                    @endphp
                    <div class="col-lg-4 col-md-6">
                        <div class="single-latest-news" style="background-color: #ffffff;">
                            <a href="{{ url('privilege') }}/{{ $value->id }}/{{ $value->name }}">
                                <img src="{{ url('images/campaign') }}/{{ $value->image }}"
                                    class="latest-news-bg img-responsive" width="100%">
                            </a>
                            <div class="news-text-box">
                                <h1><a href="{{ url('privilege') }}/{{ $value->id }}/{{ $value->name }}">{{ $value->name }}</a></h1>
                                <div style="min-height: 60px;">{!! $value->detail !!}</div>
                                <p class="mt-3">ใช้คูปองได้ที่ <i class="fa fa-caret-right"></i> {{ $partner }}</p>
                                <div style="border-bottom: 2px dashed #cac8c8;"></div>
                                <div class="flex space-between mt-3" >
                                    <p class="blog-meta">
                                        @php
                                            $date_format = date('d-m-Y', strtotime($value->expire_date));
                                        @endphp
                                        <strong style="color: red;">สิ้นสุดแคมเปญ {{ $date_format }}</strong>
                                    </p>
                                    <a href="{{ url('privilege') }}/{{ $value->id }}/{{ $value->name }}"
                                        style="text-align:end;">รายละเอียดเพิ่มเติม
                                        <i class="fa fa-caret-right"></i></a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container mb-5">
        <center>
            <div class="header-title">
                <h2 style="margin-top: 5rem;">
                    <strong>สิทธิประโยชน์สมาชิก 1Choice</strong>
                </h2>
            </div>
        </center>
        <br>
        <div class="row mt-5">
            <div class="col-lg-4 col-md-4">
                <div class="privilege text-center">
                    <i class="fas fa-parking"></i>
                    <h4>สะสมคะแนน</h4>
                    <p>
                        คะแนนสะสมไม่มีวันหมดอายุ
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="privilege text-center">
                    <i class="fas fa-ticket"></i>
                    <h4>รับส่วนลดพิเศษ</h4>
                    <p>
                        รับส่วนลดพิเศษในเครือข่ายพันธมิตร
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="privilege text-center">
                    <i class="fas fa-gift"></i>
                    <h4>ของรางวัลพรีเมี่ยม</h4>
                    <p>
                        แลกรับของรางวัลพรีเมี่ยม
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
