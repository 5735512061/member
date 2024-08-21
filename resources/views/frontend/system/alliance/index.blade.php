@extends('frontend/layouts/template')

@section('content')
    {{-- <div style="background-color:#2e5b55;">
        <div class="container" style="padding-bottom: 5rem; padding-top: 5rem;">
            <br>
            <div class="header-title">
                <h4 style="color: #f0b6b5;">
                    <strong>PARTNER</strong>
                </h4>
            </div>
        </div>
    </div> --}}
    <div style="background-color:#f0b6b5;">
        <div class="container" style="padding-bottom: 5rem; padding-top: 5rem;">
            <br>
            <div class="header-title">
                <h4 style="color: #2e5b55;">
                    <strong>อัพเกรดสมาชิก และสะสมคะแนน ได้ที่เครือข่ายของทัชใจ</strong>
                </h4>
            </div>
            <div class="row mt-3">
                @foreach ($account_stores as $account_store => $value)
                    <div class="col-lg-2 col-md-2 col-6">
                        <img src="{{ url('images/store-logo') }}/{{ $value->image }}" class="mt-3">
                    </div>
                @endforeach
            </div>
            <br>
            <div class="header-title">
                <h4 style="color: #2e5b55;">
                    <strong>รับส่วนลดพิเศษ ได้ที่เครือข่ายพันธมิตร</strong>
                </h4>
            </div>
            <div class="row mt-3">
                @foreach ($partners as $partner => $value)
                    <div class="col-lg-2 col-md-2 col-6">
                        <img src="{{ url('images/partner_shop') }}/{{ $value->image }}" class="mt-3">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- <div class="container" style="margin-bottom: 50px;"> --}}
    {{-- <center>
            <div class="header-title">
                <h2 style="margin-top:15rem;">
                    <strong>พันธมิตรที่ร่วมรายการ</strong>
                </h2>
            </div>
        </center><br> --}}
    {{-- <div class="row alliance">
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
        </div> --}}
    {{-- <div class="header-title">
            <h2 style="padding-top: 5rem;">
                <strong>สิทธิพิเศษ</strong>
            </h2>
            <div style="display: flex; justify-content: space-between;">
                <h4>รับส่วนลดพิเศษในเครือข่ายพันธมิตร</h4>
            </div>
        </div>
        <div class="latest-news mt-5">
            <div class="row">
                @foreach ($partner_promotions as $partner_promotion => $value)
                    @php
                        $name = DB::table('partner_shops')
                            ->where('id', $value->partner_id)
                            ->value('name');
                        $branch = DB::table('partner_shops')
                            ->where('id', $value->partner_id)
                            ->value('branch');
                        $partner_point = DB::table('partner_shop_points')
                            ->where('partner_id', $value->id)
                            ->value('point');
                    @endphp
                    <div class="col-lg-4 col-md-6">
                        <div class="single-latest-news" style="background-color: #ffffff;">
                            <a href="{{ url('alliance') }}/{{ $value->id }}/{{ $name }}">
                                <img src="{{ url('images/partner') }}/{{ $value->image }}"
                                    class="latest-news-bg img-responsive" width="100%">
                            </a>
                            <div class="news-text-box">
                                <h1><a href="{{ url('alliance') }}/{{ $value->id }}/{{ $value->name }}">{{ $name }}
                                        @if ($branch != null)
                                            สาขา{{ $branch }}
                                        @endif
                                    </a>
                                </h1>
                                <div>{!! $value->promotion !!}</div><br>
                                <div style="border-bottom: 2px dashed #cac8c8;"></div>
                                <div class="flex space-between">
                                    <p>ใช้พอยท์ <i class="fa fa-caret-right" style="color:#777777;"></i>
                                        <span
                                            style="color: red; font-size:25px;"><strong>{{ $partner_point }}</strong></span>
                                        พอยท์
                                    </p>
                                    <div style="text-align: right;" class="mt-3">
                                        <a href="{{ url('alliance') }}/{{ $value->id }}/{{ $name }}">รายละเอียดเพิ่มเติม
                                            <i class="fa fa-caret-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="header-title mt-5">
            <h4 style="color: #e57d0d;">
                <strong>เครือข่ายพันธมิตร</strong>
            </h4>
            <h4>รับส่วนลดพิเศษในเครือข่ายพันธมิตร</h4>
        </div>
        <div class="row mt-3">
            @foreach ($partners as $partner => $value)
                <div class="col-lg-2 col-md-2 col-6">
                    <img src="{{ url('images/partner_shop') }}/{{ $value->image }}" class="mt-3">
                </div>
            @endforeach
        </div> --}}
    {{-- </div> --}}
@endsection
