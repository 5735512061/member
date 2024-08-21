@extends('frontend/layouts/template')

@section('content')
    <div class="container" style="padding-bottom: 50px;">
        <center>
            <div class="header-title">
                <h2 style="padding-top:5rem;">
                    <strong>เกี่ยวกับเรา</strong>
                </h2>
            </div>
        </center>
        <br>
        <div class="row">
            <div class="col-md-12">
                <h4 style="line-height: 1.4em;"><Span style="color: #f0b6b5;"><strong>TOUCHJAI (สมาชิกทัชใจ)</strong></Span>
                    ระบบสมาชิกลอยัลตี้ ที่สามารถสะสมคะแนนได้ทุกยอดการใช้จ่ายในเครือของทัชใจ
                    รับส่วนลดพิเศษในเครือข่ายพันธมิตรทางธุรกิจ
                    ไม่ว่าจะเป็นอาหาร เครื่องดื่ม ไลฟ์สไตล์ การท่องเที่ยว บริการด้านรถยนต์ และอื่นๆอีกมากมาย
                    ครอบคลุมทุกไลฟ์สไตล์ของสมาชิกทัชใจ อิสระทุกความรู้สึก ทัชใจทุกครั้งที่ใช้
                </h4>
            </div>
        </div>
    </div>
    <div style="background-color:#f0b6b5;">
        <div class="container" style="padding-bottom: 5rem;">
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
@endsection
