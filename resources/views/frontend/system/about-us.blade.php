@extends('frontend/layouts/template')

@section('content')
    <div class="container" style="margin-bottom: 50px;">
        <center>
            <div class="header-title">
                <h2 style="margin-top:15rem;">
                    <strong>เกี่ยวกับเรา</strong>
                </h2>
            </div>
        </center>
        <br>
        <div class="row">
            <h4 style="line-height: 1.4em;"><Span style="color: red;"><strong>LOCK (ล็อค)</strong></Span>
                ระบบสมาชิกลอยัลตี้ ที่สามารถสะสมคะแนนได้ทุกยอดการใช้จ่ายในเครือของ LOCK แลกคะแนนสะสมเป็นคูปองเงินสด
                ใช้ในเครือพันธมิตรทางธุรกิจ
                ไม่ว่าจะเป็นอาหาร เครื่องดื่ม ไลฟ์สไตล์ การท่องเที่ยว บริการด้านรถยนต์ และอื่นๆอีกมากมาย
                หรือจะแลกเป็นของรางวัลสุดพรีเมี่ยม
                และยังครอบคลุมทุกไลฟ์สไตล์ของสมาชิก
            </h4>
        </div>
    </div>
    <div style="background-color:#313131;">
        <div class="container" style="padding-bottom: 5rem;">
            <center>
                <div class="header-title">
                    <h2 style="padding-top: 5rem;">
                        <strong>สิทธิประโยชน์สมาชิก LOCK</strong>
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
    </div>
    <div>
        <div class="container" style="padding-bottom: 5rem;">
            <div class="header-title">
                <h2 style="padding-top: 5rem;">
                    <strong>เครือข่าย LOCK และเครือข่ายพันธมิตร</strong>
                </h2>
                <h4>รับส่วนลดพิเศษในเครือข่ายพันธมิตร</h4>
            </div>
            <br>
            <div class="header-title">
                <h4 style="color: #e57d0d;">
                    <strong>เครือข่าย LOCK</strong>
                </h4>
            </div>
            <div class="row mt-3">
                @foreach ($account_stores as $account_store => $value)
                    <div class="col-lg-2 col-md-2">
                        <img src="{{ url('images/store-logo') }}/{{ $value->image }}">
                    </div>
                @endforeach
            </div>
            <br>
            <div class="header-title">
                <h4 style="color: #e57d0d;">
                    <strong>เครือข่ายพันธมิตร</strong>
                </h4>
            </div>
            <div class="row mt-3">
                @foreach ($partners as $partner => $value)
                    <div class="col-lg-2 col-md-2">
                        <img src="{{ url('images/partner_shop') }}/{{ $value->image }}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
