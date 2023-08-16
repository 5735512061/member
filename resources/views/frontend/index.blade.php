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
                    <strong>ของรางวัล</strong>
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
                <div class="row">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($rewards as $reward => $value)
                                @php
                                    $reward_point = DB::table('reward_points')
                                        ->where('reward_id', $value->id)
                                        ->value('point');
                                @endphp
                                <div class="col-md-3 mt-3">
                                    <div class="card ">
                                        <div class="card-body">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                                class="img-responsive" width="100%">
                                            <p class="mb-0 mt-4">
                                                {{ $value->name }}</p>
                                            <p class="mb-3">ใช้พอยท์ <i class="fa fa-caret-right"
                                                    style="color:#777777;"></i>
                                                <span>{{ $reward_point }}</span> พอยท์
                                            </p>
                                            <div style="border-bottom: 2px dashed #cac8c8;"></div>
                                            <div style="text-align: right;" class="mt-3">
                                                <a href="{{ url('reward-detail') }}/{{ $value->id }}"
                                                    class="btn btn-outline-primary radius-15">รายละเอียด</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                            @endforeach
                        </div>
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
        <div class="row">
            <div class="card-body">
                <div class="row">
                    @foreach ($rewards as $reward => $value)
                        @php
                            $reward_point = DB::table('reward_points')
                                ->where('reward_id', $value->id)
                                ->value('point');
                        @endphp
                        <div class="col-md-3 mt-3">
                            <div class="card ">
                                <div class="card-body">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                        class="img-responsive" width="100%">
                                    <p class="mb-0 mt-4">
                                        {{ $value->name }}</p>
                                    <p class="mb-3">ใช้พอยท์ <i class="fa fa-caret-right"
                                            style="color:#777777;"></i>
                                        <span>{{ $reward_point }}</span> พอยท์
                                    </p>
                                    <div style="border-bottom: 2px dashed #cac8c8;"></div>
                                    <div style="text-align: right;" class="mt-3">
                                        <a href="{{ url('reward-detail') }}/{{ $value->id }}"
                                            class="btn btn-outline-primary radius-15">รายละเอียด</a>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div style="background-color:#313131; margin-top:10rem;">
        <div class="container" style="padding-bottom: 5rem;">
            <div class="header-title">
                <h2 style="padding-top: 5rem;">
                    <strong>ข่าวสารและกิจกรรม</strong>
                </h2>
                <div style="display: flex; justify-content: space-between;">
                    <h4>ข่าวสารและกิจกรรม</h4>
                    <a href="{{ url('news-activities') }}">
                        <p style="color: #ffffff;">ดูเพิ่มเติม <i class="fa fa-chevron-right" aria-hidden="true"></i></p>
                    </a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <div class="card ">
                                <div class="card-body">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="img-responsive"
                                        width="100%">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="card ">
                                <div class="card-body">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="img-responsive"
                                        width="100%">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="card ">
                                <div class="card-body">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="img-responsive"
                                        width="100%">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="card ">
                                <div class="card-body">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="img-responsive"
                                        width="100%">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="card ">
                                <div class="card-body">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="img-responsive"
                                        width="100%">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="card ">
                                <div class="card-body">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="img-responsive"
                                        width="100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
