@extends('frontend/layouts/template')
<link type="text/css" href="{{ asset('frontend/assets/css/carousel-slide.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
@section('content')
    @php
        $image_slides = DB::table('slide_image_mains')
            ->where('status', 'เปิด')
            ->get();
    @endphp
    <section class="hero-slider hero-style">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach ($image_slides as $image_slide => $value)
                    <div class="swiper-slide">
                        <div class="slide-inner slide-bg-image"
                            data-background="{{ url('images/slide_main') }}/{{ $value->image }}">
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- swipper controls -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next-js"></div>
            <div class="swiper-button-prev-js"></div>
        </div>
    </section>
    <div class="container">
        <center>
            <div class="header-title">
                <h2 style="margin-top:5rem;">
                    <strong>ISSARA MEMBER PRIVILEGE</strong>
                </h2>
            </div>
        </center>
        <br>
        <div class="row mt-3">
            <div class="col-lg-4 col-md-4 mt-5">
                <div class="privilege text-center">
                    <i class="fas fa-parking"></i>
                    <h4>สะสมคะแนน</h4>
                    <p>
                        คะแนนสะสมไม่มีวันหมดอายุ
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 mt-5">
                <div class="privilege text-center">
                    <i class="fas fa-ticket"></i>
                    <h4>รับส่วนลดพิเศษ</h4>
                    <p>
                        รับส่วนลดพิเศษในเครือข่ายพันธมิตร
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 mt-5">
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
    <div class="container" style="margin-top:5rem;">
        <div class="header-title">
            <h2 style="color: #e57d0d;">
                <strong>เครือข่ายพันธมิตร</strong>
            </h2>
            <h4>รับส่วนลดพิเศษในเครือข่ายพันธมิตร</h4>
        </div>
        <div class="row mt-5">
            @foreach ($partners as $partner => $value)
                <div class="col-lg-2 col-md-2 col-6">
                    <img src="{{ url('images/partner_shop') }}/{{ $value->image }}" class="mt-3">
                </div>
            @endforeach
        </div>
    </div>
    <div style="background-color:#313131; margin-top:5rem;">
        <div class="container" style="padding-bottom: 5rem;">
            <div class="header-title">
                <h2 style="padding-top: 5rem;">
                    <strong>REWARD</strong>
                </h2>
                <div style="display: flex; justify-content: space-between;">
                    <h4>แลกรับของรางวัลพรีเมี่ยม</h4>
                    <a href="{{ url('rewards') }}">
                        <p style="color: #ffffff;">ดูเพิ่มเติม <i class="fa fa-chevron-right" aria-hidden="true"></i></p>
                    </a>
                </div>
            </div>
            <br>
            @if (count($rewards) != 0)
                <div class="reward">
                    <div class="row">
                        @foreach ($rewards as $reward => $value)
                            @php
                                $reward_point = DB::table('reward_points')
                                    ->where('reward_id', $value->id)
                                    ->value('point');
                            @endphp
                            <div class="col-md-4">
                                <div class="card" style="border: 0;">
                                    <div class="card-body" style="padding: 0;">
                                        <img src="{{ url('images/reward') }}/{{ $value->image }}" class="img-responsive"
                                            width="100%">
                                        <div class="news-text-box" style="padding: 15px;">
                                            <h1><a
                                                    href="{{ url('reward-detail') }}/{{ $value->id }}">{{ $value->name }}</a>
                                            </h1>
                                            <div class="excerpt">{!! $value->detail !!}</div>
                                            <div style="border-bottom: 2px dashed #cac8c8;"></div>

                                            <div class="flex space-between">
                                                <p>ใช้พอยท์ <i class="fa fa-caret-right" style="color:#777777;"></i>
                                                    <span
                                                        style="color: red; font-size:25px;"><strong>{{ $reward_point }}</strong></span>
                                                    พอยท์
                                                </p>
                                                <div style="text-align: right;" class="mt-3">
                                                    <a href="{{ url('reward-detail') }}/{{ $value->id }}">รายละเอียดเพิ่มเติม
                                                        <i class="fa fa-caret-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <h2 style="text-align: center;">Coming Soon</h2>
            @endif
        </div>
    </div>
    <div class="container">
        <div class="header-title">
            <h2 style="padding-top: 5rem;">
                <strong>พันธมิตรในเครือ</strong>
            </h2>
            <div style="display: flex; justify-content: space-between;">
                <h4>รับส่วนลดพิเศษในเครือข่ายพันธมิตร</h4>
            </div>
        </div>
        <div class="row alliance mb-5">
            <div class="col-md-3 mt-3">
                <div class="card alliance-food">
                    <div class="card-body text-center centered-element">
                        <h3 class="text-center">Food And Drink</h3><br>
                        <a href="{{ url('alliance-foodanddrink') }}">สิทธิพิเศษ</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-3">
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
            <div class="col-md-3 mt-3">
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
            <div class="col-md-3 mt-3">
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
    <div style="background-color:#313131;">
        <div class="container" style="padding-bottom: 5rem;">
            <div class="header-title">
                <h2 style="padding-top: 5rem;">
                    <strong>บทความ ข่าวสาร</strong>
                </h2>
                <div style="display: flex; justify-content: space-between;">
                    <h4>ติดตามบทความ และข่าวสาร</h4>
                    <a href="{{ url('allarticle') }}">
                        <p style="color: #ffffff;">ดูเพิ่มเติม <i class="fa fa-chevron-right" aria-hidden="true"></i></p>
                    </a>
                </div>
            </div>
            <br>
            <div class="latest-news mb-80">
                <div class="row">
                    @foreach ($articles as $article => $value)
                        <div class="col-lg-4 col-md-6">
                            <div class="single-latest-news" style="background-color: #ffffff;">
                                <a href="{{ url('article') }}/{{ $value->id }}/{{ $value->title }}">
                                    <img src="{{ url('images/article') }}/{{ $value->image }}"
                                        class="latest-news-bg img-responsive" width="100%">
                                </a>
                                <div class="news-text-box">
                                    <p class="blog-meta">
                                        <span>บทความ{{ $value->type }}</span>
                                    </p>
                                    <h1><a
                                            href="{{ url('article') }}/{{ $value->id }}/{{ $value->title }}">{{ $value->title }}</a>
                                    </h1>
                                    <div class="excerpt">{!! $value->article !!}</div><br>
                                    <div style="text-align: right;">
                                        <a href="{{ url('article') }}/{{ $value->id }}/{{ $value->title }}">read
                                            more <i class="fa fa-caret-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('frontend/assets/js/carousel-slide.js') }}"></script>
@endsection
