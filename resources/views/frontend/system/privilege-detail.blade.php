@extends('frontend/layouts/template')

@section('content')
@php
    $coupons = DB::table('campaigns')->where('id','!=',$coupon->id)->paginate(10);
    $partner = DB::table('partner_shops')->where('id',$coupon->partner_id)->value('name');
@endphp
    <div class="container" style="margin-bottom: 50px;">
        <center>
            <div class="header-title">
                <h1 style="margin-top:15rem; color: #f28123;">
                    <strong>สิทธิประโยชน์พิเศษ</strong>
                </h1>
            </div>
        </center>
        <br>
        <!-- single article section -->
        <div class="mt-100 mb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="single-article-section">
                            <div class="single-article-text">
                                <img src="{{ url('images/campaign') }}/{{ $coupon->image }}" class="img-responsive"
                                    width="100%">
                                <h1 class="article-title">{{ $coupon->name }}</h1>
                                <div class="article-detail">{!! $coupon->detail !!}</div>
                                <p class="mt-3">ใช้คูปองได้ที่ <i class="fa fa-caret-right"></i> {{ $partner }}</p>
                                <p class="blog-meta">
                                    <strong style="color: red;">สิ้นสุดแคมเปญ {{ $coupon->expire_date }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="sidebar-section">
                            <div class="recent-posts">
                                <h4>Others Coupon</h4>
                                <ul>
                                    @foreach ($coupons as $coupon => $value)
                                        <li><a href="{{ url('privilege') }}/{{$value->id}}/{{$value->name}}">{{$value->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tag-section">
                                <h4>Tags</h4>
                                <ul>
                                    <li><a href="">อาหาร</a></li>
                                    <li><a href="">ไลฟ์สไตล์</a></li>
                                    <li><a href="">บิวตี้</a></li>
                                    <li><a href="">ข่าว</a></li>
                                    <li><a href="">ดูดวง</a></li>
                                    <li><a href="">ทั่วไป</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end single article section -->
    </div>
@endsection
