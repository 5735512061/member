@extends('frontend/layouts/template')
<link type="text/css" href="{{ asset('frontend/assets/css/accordion.css') }}" rel="stylesheet">
@section('content')
    <div class="container" style="margin-bottom: 50px;">
        <center>
            <div class="header-title">
                <h2 style="margin-top:10rem;">
                    <strong>ศูนย์ช่วยเหลือสมาชิก</strong>
                </h2>
            </div>
        </center>
        <br>
    </div>
    <div class="container mb-150">
        <div class="accordion">
            <!-- Item 1 -->
            <div class="accordion-item">
                <input type="checkbox" id="item-1" />
                <label for="item-1" class="accordion-header">
                    <span>ระบบสมาชิกอิสระ คืออะไร ?</span>
                </label>
                <div class="accordion-content">
                    <h5><Span style="color: red;"><strong>ISSARA MEMBER
                                (สมาชิกอิสระ)</strong></Span>
                        ระบบสมาชิกลอยัลตี้ ที่สามารถสะสมคะแนนได้ทุกยอดการใช้จ่ายในเครือของอิสระ แลกคะแนนสะสมเป็นคูปองเงินสด
                        ใช้ในเครือพันธมิตรทางธุรกิจ
                        ไม่ว่าจะเป็นอาหาร เครื่องดื่ม ไลฟ์สไตล์ การท่องเที่ยว บริการด้านรถยนต์ และอื่นๆอีกมากมาย
                        หรือจะแลกเป็นของรางวัลสุดพรีเมี่ยม
                        และยังครอบคลุมทุกไลฟ์สไตล์ของสมาชิก
                    </h5>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="accordion-item">
                <input type="checkbox" id="item-2" />
                <label for="item-2" class="accordion-header">
                    <span>สมัครสมาชิกอิสระ ได้อย่างไร ?</span>
                </label>
                <div class="accordion-content">
                    <h5>
                        สมัครสมาชิก <Span style="color: red;"><strong> ISSARA</strong></Span> เพื่อสะสมคะแนน และรับสิทธิพิเศษได้ง่าย ๆ ที่เครือข่าย <Span style="color: red;"><strong> ISSARA</strong></Span>
                    </h5>
                    <div class="header-title">
                        <h4 style="color: #e57d0d;">
                            <strong>เครือข่ายอิสระ</strong>
                        </h4>
                    </div>
                    <div class="row mt-3">
                        @foreach ($account_stores as $account_store => $value)
                            <div class="col-lg-2 col-md-2 mb-5">
                                <img src="{{ url('images/store-logo') }}/{{ $value->image }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="accordion-item">
                <input type="checkbox" id="item-3" />
                <label for="item-3" class="accordion-header">
                    <span>ต้องใช้อะไรในการสมัครสมาชิกบ้าง ?</span>
                </label>
                <div class="accordion-content">
                    <h5>
                        สำหรับการสมัครสมาชิก ใช้เพียงหมายเลขบัตรประชาชน และหมายเลขโทรศัพท์มือถือ ก็สามารถเป็นสมาชิก <Span style="color: red;"><strong>ISSARA</strong></Span>
                        ได้ง่าย ๆ
                    </h5>
                </div>
            </div>

            <!-- Item 4 -->
            <div class="accordion-item">
                <input type="checkbox" id="item-4" />
                <label for="item-4" class="accordion-header">
                    <span>คะแนนสะสมมีวันหมดอายุหรือไม่ ?</span>
                </label>
                <div class="accordion-content">
                    <h5>
                        คะแนนสะสมไม่มีวันหมดอายุ สามารถใช้คะแนนสะสมในการแลกของรางวัลพิเศษ และใช้สิทธิพิเศษพันธมิตรในเครือ
                    </h5>
                </div>
            </div>

            <!-- Item 5 -->
            <div class="accordion-item">
                <input type="checkbox" id="item-5" />
                <label for="item-5" class="accordion-header">
                    <span>สามารถเช็คคะแนนสะสมได้ที่ใดบ้าง ?</span>
                </label>
                <div class="accordion-content">
                    <h5>
                        สามารถเช็คคะแนนสะสมได้ผ่านทางเว็บไซต์
                    </h5>
                </div>
            </div>
        </div>
    </div>
@endsection
