@extends('frontend/layouts/template')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<style>
    .job-tab .nav-tabs {
        margin-bottom: 60px;
        border-bottom: 0;
    }

    .job-tab .nav-tabs>li {
        float: none;
        display: inline;
    }

    .job-tab .nav-tabs li {
        margin-right: 15px;
    }

    .job-tab .nav-tabs li:last-child {
        margin-right: 0;
    }

    .job-tab .nav-tabs {
        position: relative;
        z-index: 1;
        display: inline-block;
    }

    .job-tab .nav-tabs:after {
        position: absolute;
        content: "";
        top: 50%;
        left: 0;
        width: 100%;
        height: 1px;
        background-color: #fff;
        z-index: -1;
    }

    .job-tab .nav-tabs>li a {
        display: inline-block;
        background-color: #fff;
        border: none;
        border-radius: 30px;
        font-size: 14px;
        color: #000;
        padding: 5px 30px;
    }

    .job-tab .nav-tabs>li>a.active,
    .job-tab .nav-tabs>li a.active>:focus,
    .job-tab .nav-tabs>li>a.active:hover,
    .job-tab .nav-tabs>li>a:hover {
        border: none;
        background-color: #f0b6b5;
        color: #fff;
    }

    .job-tab .tab-content h3 {
        color: #f0b6b5;
        text-align: center;
        font-weight: bold;
    }

    .job-tab .tab-content h4 {
        line-height: 2.5rem;
    }

    .job-tab .tab-content a {
        color: #ffffff;
    }
    .job-tab .tab-content li {
        font-size: 18px;
    }
</style>
@section('content')
    <div style="background-color:#2e5b55;">
        <div class="container" style="padding-bottom: 5rem; padding-top: 5rem;">

            <div class="tr-job-posted section-padding">
                <div class="container">
                    <div class="job-tab text-center">
                        <ul class="nav nav-tabs justify-content-center" role="tablist">
                            <li role="presentation" class="active">
                                <a class="active show" href="#friend" aria-controls="friend" role="tab"
                                    data-toggle="tab" aria-selected="true">FRIEND</a>
                            </li>
                            <li role="presentation"><a href="#partner" aria-controls="partner" role="tab"
                                    data-toggle="tab" class="" aria-selected="false">PARTNER</a></li>
                            <li role="presentation"><a href="#family" aria-controls="family" role="tab"
                                    data-toggle="tab" class="" aria-selected="false">FAMILY</a></li>
                        </ul>
                        <div class="tab-content text-left">
                            <div role="tabpanel" class="tab-pane fade active show" id="friend">
                                <h3>สิทธิพิเศษสำหรับสมาชิก FRIEND</h3>
                                <h4>ร่วมเป็นครอบครัวทัชใจ ได้ง่ายๆ เพียงแค่สมัครสมาชิกผ่านไลน์ <a href="https://lin.ee/dglPjnl" target="_blank">@touchjai</a> เพื่อรับสิทธิพิเศษมากมาย 
                                    หรืออัพเกรดสมาชิกเพื่อรับสิทธิ์ได้ทุกวัน สนุกได้ไม่มีขีดจำกัด สามารถอัพเกรดสมาชิก และสะสมคะแนนได้ที่เครือข่ายของทัชใจ</h4>
                                <ul>
                                    <li>ไทร์พลัส เอกการยาง ทุกสาขา สินค้าทั้งร้านลด 5% จากราคาปกติ (ไม่รวมค่าแรง) / สลับยาง-ถ่วงล้อฟรี / ตรวจเช็ค 24 รายการฟรี</li>
                                    <li>ร้านอาหารในเครือเอโดะกรุ๊ป รับส่วนลด 5%</li>
                                    <li>BIGBOSS Work Green Brunch รับส่วนลด 5%</li>
                                    <li>Slumberland รับส่วนลด 20 บาท เมื่อมียอดขั้นต่ำ 200 บาท</li>
                                </ul>
                            </div>
                            <div role="tabpanel" class="tab-pane fade in" id="partner">
                                <h3>สิทธิพิเศษสำหรับสมาชิก PARTNER</h3>
                                <h4>อัพเกรดสมาชิกเมื่อมียอดคะแนนสะสม 2,000 คะแนนขึ้นไป รับสิทธิพิเศษได้ที่เครือข่ายพันธมิตร</h4>
                                <ul>
                                    <li>ไทร์พลัส เอกการยาง ทุกสาขา สินค้าทั้งร้านลด 10% จากราคาปกติ (ไม่รวมค่าแรง) / ปะยางฟรี / สลับยาง-ถ่วงล้อฟรี / ตรวจเช็ค 24 รายการฟรี</li>
                                    <li>ร้านอาหารในเครือเอโดะกรุ๊ป รับส่วนลด 10% และ Complimentary ตามฤดูกาล</li>
                                    <li>BIGBOSS Work Green Brunch รับส่วนลด 10%</li>
                                    <li>Slumberland รับส่วนลด 20 บาท เมื่อมียอดขั้นต่ำ 200 บาท</li>
                                </ul>
                            </div>
                            <div role="tabpanel" class="tab-pane fade in" id="family">
                                <h3>สิทธิพิเศษสำหรับสมาชิก FAMILY</h3>
                                <h4>อัพเกรดสมาชิกเมื่อมียอดคะแนนสะสม 5,000 คะแนนขึ้นไป รับสิทธิพิเศษได้ที่เครือข่ายพันธมิตร</h4>
                                <ul>
                                    <li>ไทร์พลัส เอกการยาง ทุกสาขา สินค้าทั้งร้านลด 15% จากราคาปกติ (ไม่รวมค่าแรง) / รับสิทธิ์ใช้ Fast Lane / ปะยางฟรี / สลับยาง-ถ่วงล้อฟรี / ตรวจเช็ค 24 รายการฟรี</li>
                                    <li>ร้านอาหารในเครือเอโดะกรุ๊ป รับส่วนลด 15% และ Complimentary ตามฤดูกาล</li>
                                    <li>BIGBOSS Work Green Brunch รับส่วนลด 15%</li>
                                    <li>Slumberland รับส่วนลด 20 บาท เมื่อมียอดขั้นต่ำ 200 บาท</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
