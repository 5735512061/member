<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon/android-chrome-192x192.png')}}" sizes="192x192">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon/android-chrome-256x256.png')}}" sizes="256x256">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest')}}">
    <link href="{{ asset('/browserconfig.xml')}}">
    <link rel="mask-icon" href="{{ asset('images/favicon/safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
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
