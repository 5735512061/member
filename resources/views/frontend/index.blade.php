@extends('frontend/layouts/template')

@section('content')
    <div class="container">
        <center>
            <div class="header-title">
                <h2 style="margin-top:15rem;">
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
                    <i class="fas fa-gift"></i>
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
            <div class="col-lg-4 col-md-4 mt-5 offset-4">
                <div class="privilege text-center">
                    <i class="fas fa-info-circle"></i>
                    <h4>ตรวจสอบสิทธิพิเศษ</h4>
                    <p>
                        ตรวจสอบสิทธิประโยชน์ และพันธมิตรที่ร่วมรายการ ได้ผ่านทางเว็บไซต์
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div style="background-color:#313131; margin-top:10rem;">
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
                                        <div style="padding: 15px;">
                                            <p class="mb-0 mt-4 mb-3" style="border-bottom: 2px dashed #cac8c8;">
                                                {{ $value->name }}</p>
                                            <p class="mb-2">ใช้พอยท์ <i class="fa fa-caret-right"
                                                    style="color:#777777;"></i>
                                                <span>{{ $reward_point }}</span> พอยท์
                                            </p>
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
                <a href="{{ url('alliance') }}">
                    <p style="color: #ffffff;">ดูเพิ่มเติม <i class="fa fa-chevron-right" aria-hidden="true"></i></p>
                </a>
            </div>
        </div>
        <div class="latest-news mt-80 mb-150">
            <div class="row">
                @foreach ($partners as $partner => $value)
                    @php
                        $image = DB::table('partner_shops')
                            ->where('id', $value->partner_id)
                            ->value('image');
                        $name = DB::table('partner_shops')
                            ->where('id', $value->partner_id)
                            ->value('name');
                    @endphp
                    <div class="col-lg-4 col-md-6">
                        <div class="single-latest-news" style="background-color: #ffffff;">
                            <a href="{{ url('alliance') }}/{{ $value->id }}/{{ $name }}">
                                <img src="{{ url('images/partner') }}/{{ $image }}"
                                    class="latest-news-bg img-responsive" width="100%">
                            </a>
                            <div class="news-text-box">
                                <h1><a
                                        href="{{ url('alliance') }}/{{ $value->id }}/{{ $name }}">{{ $name }}</a>
                                </h1>
                                <div class="excerpt">{!! $value->promotion !!}</div>
                                <a href="{{ url('alliance') }}/{{ $value->id }}/{{ $name }}"
                                    class="read-more-btn">รายละเอียดเพิ่มเติม <i class="fa fa-caret-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
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
            <div class="latest-news mb-150">
                <div class="row">
                    @foreach ($articles as $article => $value)
                        <div class="col-lg-4 col-md-6">
                            <div class="single-latest-news" style="background-color: #ffffff;">
                                <a href="{{ url('article') }}/{{ $value->id }}/{{ $value->title }}">
                                    <img src="{{ url('images/article') }}/{{ $value->image }}"
                                        class="latest-news-bg img-responsive" width="100%">
                                </a>
                                <div class="news-text-box">
                                    <h1><a
                                            href="{{ url('article') }}/{{ $value->id }}/{{ $value->title }}">{{ $value->title }}</a>
                                    </h1>
                                    <p class="blog-meta">
                                        <span>บทความ{{ $value->type }}</span>
                                    </p>
                                    <div class="excerpt">{!! $value->article !!}</div>
                                    <a href="{{ url('article') }}/{{ $value->id }}/{{ $value->title }}"
                                        class="read-more-btn">read
                                        more <i class="fa fa-caret-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
