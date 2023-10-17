@extends('frontend/layouts/template')

@section('content')
    @php
        $partner = DB::table('partner_shops')
            ->where('id', $promotion->partner_id)
            ->value('name');
        $branch = DB::table('partner_shops')
            ->where('id', $promotion->partner_id)
            ->value('branch');
        $partner_type = DB::table('partner_shops')
            ->where('id', $promotion->partner_id)
            ->value('type');
    @endphp
    <div class="container" style="margin-bottom: 50px;">
        <!-- single article section -->
        <div class="row">
            <div class="col-lg-6 mt-5">
                <div class="single-article-section">
                    <div class="single-article-text">
                        <img src="{{ url('images/partner') }}/{{ $promotion->image }}" class="img-responsive" width="100%">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="single-article-section">
                    <div class="single-article-text">
                        <h1 class="article-title">{{ $partner }} @if ($branch != null)
                                สาขา{{ $branch }}
                            @endif
                        </h1>
                        <div class="article-detail">{!! $promotion->promotion !!}</div>
                        <h5 class="mt-5">เงื่อนไขการใช้สิทธิพิเศษ</h5>
                        <ui>
                            <li>ไม่สามารถใช้ร่วมกับโปรโมชั่นส่งเสริมการขายอื่นได้</li>
                            <li>บริษัทฯ ถือตามข้อมูลที่ปรากฏในระบบของบริษัทฯ เป็นสำคัญ</li>
                            <li>เงื่อนไขเป็นไปตามที่บริษัทฯ กำหนด ขอสงวนสิทธิ์ในการเปลี่ยนแปลง แก้ไข
                                โดยไม่ต้องแจ้งให้ทราบล่วงหน้า</li>
                        </ui>
                    </div>
                </div>
                <a href="{{ url('member/alliance-redeem/') }}/{{ $promotion->id }}" class="btn btn-block btn-success mt-3"
                    style="color: #ffffff;">กดใช้สิทธิพิเศษ</a>
            </div>
        </div>
        <!-- end single article section -->
    </div>
    <div class="container">
        <div class="header-title">
            <h2 style="padding-top: 5rem;">
                <strong>{{ $partner_type }}</strong>
            </h2>
            <div style="display: flex; justify-content: space-between;">
                <h4>รับส่วนลดพิเศษในเครือข่ายพันธมิตร</h4>
            </div>
        </div>
        @php
            $partners = DB::table('partner_shops')
                ->join('partner_shop_promotions', 'partner_shops.id', '=', 'partner_shop_promotions.partner_id')
                ->where('partner_shops.status', '=', 'เปิด')
                ->where('partner_shop_promotions.status', '=', 'เปิด')
                ->where('partner_shops.type', '=', $partner_type)
                ->where('partner_shop_promotions.id', '!=', $promotion->id)
                ->select('partner_shops.*', 'partner_shop_promotions.*')
                ->get();
        @endphp
        <div class="latest-news mt-5">
            <div class="carousel-inner">
                @foreach ($partners as $partner => $value)
                    @php
                        $name = DB::table('partner_shops')
                            ->where('id', $value->partner_id)
                            ->value('name');
                        $branch = DB::table('partner_shops')
                            ->where('id', $value->partner_id)
                            ->value('branch');
                    @endphp
                    <div class="col-lg-12">
                        <div class="single-latest-news" style="background-color: #ffffff;">
                            <a href="{{ url('alliance') }}/{{ $value->id }}/{{ $name }}">
                                <img src="{{ url('images/partner') }}/{{ $value->image }}"
                                    class="latest-news-bg img-responsive" width="100%">
                            </a>
                            <div class="news-text-box">
                                <h1><a href="{{ url('alliance') }}/{{ $value->id }}/{{ $value->name }}">{{ $name }}
                                        @if ($branch != null)
                                            สาขา{{ $branch }} @endif
                                    </a>    
                                </h1>
                                <div>{!! $value->promotion !!}</div><br>
                                <div style="border-bottom: 2px dashed #cac8c8;"></div>
                                <div style="text-align:right;">
                                    <a href="{{ url('alliance') }}/{{ $value->id }}/{{ $name }}">รายละเอียดเพิ่มเติม
                                        <i class="fa fa-caret-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container" style="margin-bottom: 50px;">
        <center>
            <div class="header-title">
                <h2 style="margin-top:5rem;">
                    <strong>พันธมิตรที่ร่วมรายการ</strong>
                </h2>
            </div>
        </center><br>
        <div class="row alliance">
            <div class="col-md-3">
                <div class="card alliance-food">
                    <div class="card-body text-center centered-element">
                        <h3 class="text-center">Food And Drink</h3><br>
                        <a href="{{ url('alliance-foodanddrink') }}">สิทธิพิเศษ</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card alliance-lifestyle">
                    <div class="card-body text-center centered-element">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Life Style</h3><br>
                                <a href="{{ url('alliance-lifestyle') }}">สิทธิพิเศษ</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card alliance-travel">
                    <div class="card-body text-center centered-element">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Travel</h3><br>
                                <a href="{{ url('alliance-travel') }}">สิทธิพิเศษ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card alliance-car">
                    <div class="card-body text-center centered-element">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Car Service</h3><br>
                                <a href="{{ url('alliance-carservice') }}">สิทธิพิเศษ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
