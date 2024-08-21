<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'TOUCHJAI (สมาชิกทัชใจ) ระบบสมาชิกลอยัลตี้ ที่สามารถสะสมคะแนนได้ทุกยอดการใช้จ่ายในเครือของทัชใจ รับส่วนลดพิเศษในเครือพันธมิตรทางธุรกิจ ไม่ว่าจะเป็นอาหาร เครื่องดื่ม ไลฟ์สไตล์ การท่องเที่ยว บริการด้านรถยนต์ และอื่นๆอีกมากมาย หรือจะแลกเป็นของรางวัลสุดพรีเมี่ยม และยังครอบคลุมทุกไลฟ์สไตล์ของสมาชิก')">
    <meta name="keywords" content="@yield('meta_keywords', 'ร้านอาหารภูเก็ต,แนะนำร้านอาหารในภูเก็ต,ที่พักในภูเก็ต,ร้านชาบู ภูเก็ต,restaurant,คาเฟ่ ภูเก็ต,ร้านอาหารญี่ปุ่น ภูเก็ต,ร้านราเมน,Ramen')">
    <title>TOUCHJAI</title>
    @include('/frontend/layouts/css')
</head>

<body>

    <!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->
    @include('frontend/layouts/navbar')
    <div style="padding-top: 7rem;">
        @yield('content')
    </div>
    @include('frontend/layouts/footer')
    @include('frontend/layouts/js')
</body>

</html>
