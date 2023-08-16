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
                    <span>ระบบสมาชิก 1Choice คืออะไร ?</span>
                </label>
                <div class="accordion-content">
                    <p>
                        ระบบสมาชิก
                    </p>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="accordion-item">
                <input type="checkbox" id="item-2" />
                <label for="item-2" class="accordion-header">
                    <span>สมัครสมาชิก 1Choice ได้อย่างไร ?</span>
                </label>
                <div class="accordion-content">
                    <p>
                        สมัครสมาชิก 1Choice ได้ง่าย ๆ ที่เครือข่ายพันธมิตรของทาง 1Choice
                    </p>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="accordion-item">
                <input type="checkbox" id="item-3" />
                <label for="item-3" class="accordion-header">
                    <span>ต้องใช้อะไรในการสมัครสมาชิกบ้าง ?</span>
                </label>
                <div class="accordion-content">
                    <p>
                        สำหรับการสมัครสมาชิก ใช้เพียงหมายเลขบัตรประชาชน และหมายเลขโทรศัพท์มือถือ ก็สามารถเป็นสมาชิก 1Choice
                        ได้ง่าย ๆ
                    </p>
                </div>
            </div>

            <!-- Item 4 -->
            <div class="accordion-item">
                <input type="checkbox" id="item-4" />
                <label for="item-4" class="accordion-header">
                    <span>คะแนนสะสมมีวันหมดอายุหรือไม่ ?</span>
                </label>
                <div class="accordion-content">
                    <p>
                        คะแนนสะสมไม่มีวันหมดอายุ สามารถใช้คะแนนสะสมในการแลกของรางวัลพิเศษ และใช้สิทธิพิเศษพันธมิตรในเครือ
                    </p>
                </div>
            </div>

            <!-- Item 5 -->
            <div class="accordion-item">
                <input type="checkbox" id="item-5" />
                <label for="item-5" class="accordion-header">
                    <span>สามารถเช็คคะแนนสะสมได้ที่ใดบ้าง ?</span>
                </label>
                <div class="accordion-content">
                    <p>
                        สามารถเช็คคะแนนสะสมได้ผ่านทางเว็บไซต์
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
