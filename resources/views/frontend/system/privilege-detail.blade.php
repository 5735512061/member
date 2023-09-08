@extends('frontend/layouts/template')
<style>
    .article-detail p {
        color: #ffffff;
        font-size: 1.5rem;
    }
</style>
@section('content')
    @php
        $coupons = DB::table('campaigns')
            ->where('id', '!=', $coupon->id)
            ->paginate(10);
        
        $partner = DB::table('partner_shops')
            ->where('id', $coupon->partner_id)
            ->value('name');
        if (Auth::guard('member')->user() != null) {
            $count_get_coupon = DB::table('get_coupons')
                ->where('member_id', Auth::guard('member')->user()->id)
                ->where('coupon_id', $coupon->id)
                ->count();
        } else {
            $count_get_coupon = 0;
        }
        
    @endphp
    <div class="container" style="margin-bottom: 50px;">

        <div class="mt-100 mb-150">
            @if (\Session::has('Message'))
                <div class="alert alert-success">
                    <p>{!! \Session::get('Message') !!}</p>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-6 mt-5">
                    <div class="single-article-section">
                        <div class="single-article-text">
                            <img src="{{ url('images/campaign') }}/{{ $coupon->image }}" class="img-responsive"
                                width="100%">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-5">
                    <div class="single-article-section">
                        <h1 class="article-title" style="font-size: 3.5rem; color: #F28123;">{{ $coupon->name }}</h1>
                        <div class="article-detail">{!! $coupon->detail !!}</div>
                        <p class="mt-3" style="color:#ffffff;">ใช้คูปองได้ที่ <i class="fa fa-caret-right"></i>
                            {{ $partner }}</p>
                        <p class="blog-meta">
                            @php
                                $date_format = date('d-m-Y', strtotime($coupon->expire_date));
                            @endphp
                            <strong style="color: red;">สิ้นสุดแคมเปญ {{ $date_format }}</strong>
                        </p>
                        <h5 class="mt-3">เงื่อนไขการใช้คูปอง</h5>
                        <ui>
                            <li>กรุณาเก็บหลักฐานการกดรับคูปองไว้แสดงก่อนรับสิทธิประโยชน์พิเศษ</li>
                            <li>เมื่อทำรายการแล้วไม่สามารถเปลี่ยนแปลง ยกเลิก คืน หรือ ทอน เป็นคะแนนหรือเงินสดได้</li>
                            <li>บริษัทฯ ถือตามข้อมูลที่ปรากฏในระบบของบริษัทฯ เป็นสำคัญ</li>
                            <li>เงื่อนไขเป็นไปตามที่บริษัทฯ กำหนด ขอสงวนสิทธิ์ในการเปลี่ยนแปลง แก้ไข
                                โดยไม่ต้องแจ้งให้ทราบล่วงหน้า</li>
                        </ui>
                    </div>
                    @if ($count_get_coupon == 0)
                        <a href="{{ url('member/get-coupon/') }}/{{ $coupon->id }}"
                            class="btn btn-block btn-success mt-3">กดรับคูปอง</a>
                    @else
                        <a href="{{ url('member/coupon/') }}" class="btn btn-block btn-secondary mt-3">คุณได้รับคูปองแล้ว
                            ตรวจสอบคูปองที่เมนู คูปองของฉัน</a>
                    @endif
                </div>
                <div class="col-lg-12 mt-5">
                    <div class="sidebar-section" style="margin-left: 0;">
                        <div class="recent-posts">
                            <div class="header-title">
                                <h3 style="padding-top: 5rem; color:#F28123;">
                                    <strong>OTHERS COUPON</strong>
                                </h3>
                            </div>
                            <div class="latest-news" style="margin-top: 50px;">
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
                                                    <h1><a
                                                            href="{{ url('privilege') }}/{{ $value->id }}/{{ $value->name }}">{{ $value->name }}</a>
                                                    </h1>
                                                    <div style="min-height: 50px;">{!! $value->detail !!}</div>
                                                    <p class="mt-3">ใช้คูปองได้ที่ <i class="fa fa-caret-right"></i>
                                                        {{ $partner }}</p>
                                                    <div style="border-bottom: 2px dashed #cac8c8;"></div>
                                                    <div class="flex space-between mt-3">
                                                        <p class="blog-meta">
                                                            @php
                                                                $date_format = date('d-m-Y', strtotime($value->expire_date));
                                                            @endphp
                                                            <strong style="color: red;">สิ้นสุดแคมเปญ
                                                                {{ $date_format }}</strong>
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
                        <div class="tag-section">
                            <h4>บทความ และข่าวสาร</h4>
                            <ul>
                                <li><a href="{{ url('article/food') }}">บทความ อาหาร</a></li>
                                <li><a href="{{ url('article/lifeStyle') }}">บทความ ไลฟ์สไตล์</a></li>
                                <li><a href="{{ url('article/beauty') }}">บทความ บิวตี้</a></li>
                                <li><a href="{{ url('article/news') }}">บทความ ข่าว</a></li>
                                <li><a href="{{ url('article/horoscope') }}">บทความ ดูดวง</a></li>
                                <li><a href="{{ url('article/general') }}">บทความ ทั่วไป</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end single article section -->
    </div>
@endsection
