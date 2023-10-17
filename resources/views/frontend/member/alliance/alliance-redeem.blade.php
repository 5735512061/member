@extends('frontend/layouts/template')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<style>
    .article-detail p {
        color: #ffffff;
        font-size: 1.5rem;
    }
</style>
@section('content')
    @php
        $redeem_reward_point = 0;
        $sumpoint = 0;
        $redeem_point_sum = 0;
        $balance_point = 0;
    @endphp

    {{-- point ที่ได้รับ --}}
    @foreach ($points as $point => $value)
        @php
            $price = floor($value->price / 100);
            $sumpoint += $price;
        @endphp
    @endforeach

    {{-- หักคะแนนจากการแลกของรางวัล --}}
    @foreach ($redeem_rewards as $redeem_reward => $value)
        @php
            $redeem_reward_point += $value->point;
        @endphp
    @endforeach

    {{-- หักคะแนนแลกสิทธิ์ร้านค้าพันธมิตร --}}
    @foreach ($redeem_points as $redeem_point => $value)
        @php
            $redeem_point_sum += $value->point;
        @endphp
    @endforeach

    {{-- point คงเหลือ --}}
    @php
        $balance_point = $sumpoint - $redeem_reward_point - $redeem_point_sum;
    @endphp

    @php
        $partner_point = DB::table('partner_shop_points')
            ->where('id', $point_id)
            ->orderBy('id', 'desc')
            ->value('point');
    @endphp

    <div class="container">
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4 col-12" style="text-align: right;">
                <h4 style="color: #F28123;" class="large-6 column">
                    คะแนนสะสม
                </h4>
                <h4 style="color: #ffffff;" class="large-6 column">
                    {{ number_format($balance_point) }} points
                </h4>
            </div>
        </div><br>
    </div>
    @php
        $partner = DB::table('partner_shops')
            ->where('id', $partner_promotion->partner_id)
            ->value('name');
        $branch = DB::table('partner_shops')
            ->where('id', $partner_promotion->partner_id)
            ->value('branch');
        $partner_type = DB::table('partner_shops')
            ->where('id', $partner_promotion->partner_id)
            ->value('type');
    @endphp
    <div class="container" style="margin-bottom: 50px;">
        <!-- single article section -->
        <div class="row">
            <div class="col-lg-6 mt-5">
                <div class="single-article-section">
                    <div class="single-article-text">
                        <img src="{{ url('images/partner') }}/{{ $partner_promotion->image }}" class="img-responsive"
                            width="100%">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="single-article-section">
                    <div class="single-article-text">
                        <h1 class="article-title">{{ $partner }} @if ($branch != null)
                                สาขา{{ $branch }}
                            @endif
                        </h1>
                        <div class="article-detail">{!! $partner_promotion->promotion !!}</div>
                        <h5 class="mt-5">เงื่อนไขการใช้สิทธิพิเศษ</h5>
                        <ui>
                            <li>ไม่สามารถใช้ร่วมกับโปรโมชั่นส่งเสริมการขายอื่นได้</li>
                            <li>บริษัทฯ ถือตามข้อมูลที่ปรากฏในระบบของบริษัทฯ เป็นสำคัญ</li>
                            <li>เงื่อนไขเป็นไปตามที่บริษัทฯ กำหนด ขอสงวนสิทธิ์ในการเปลี่ยนแปลง แก้ไข
                                โดยไม่ต้องแจ้งให้ทราบล่วงหน้า</li>
                        </ui>
                    </div>
                </div>
                {{-- <a href="{{ url('member/alliance-redeem/') }}/{{ $partner_promotion->id }}"
                    class="btn btn-block btn-success mt-3" style="color: #ffffff;">กดใช้สิทธิพิเศษ</a> --}}
                <button data-toggle="modal" data-target="#myModal" class="btn btn-block btn-success mt-3"
                    style="color: #ffffff;">กดใช้สิทธิพิเศษ</button>
            </div>
        </div>
        <!-- end single article section -->
    </div>
    <div class="container">
        <div class="header-title">
            <h2 style="padding-top: 5rem;">
                <strong>{{ $partner_type }}</strong>
            </h2>
            <div style="display: flex; justify-content: space-between;">
                <h4>รับส่วนลดพิเศษในเครือข่ายพันธมิตร</h4>
            </div>
        </div>
        @php
            $partners = DB::table('partner_shops')
                ->join('partner_shop_promotions', 'partner_shops.id', '=', 'partner_shop_promotions.partner_id')
                ->where('partner_shops.status', '=', 'เปิด')
                ->where('partner_shop_promotions.status', '=', 'เปิด')
                ->where('partner_shops.type', '=', $partner_type)
                ->where('partner_shop_promotions.id', '!=', $partner_promotion->id)
                ->select('partner_shops.*', 'partner_shop_promotions.*')
                ->get();
        @endphp
        <div class="latest-news mt-5">
            <div class="carousel-inner">
                @foreach ($partners as $partner => $value)
                    @php
                        $name = DB::table('partner_shops')
                            ->where('id', $value->partner_id)
                            ->value('name');
                        $branch = DB::table('partner_shops')
                            ->where('id', $value->partner_id)
                            ->value('branch');
                    @endphp
                    <div class="col-lg-12">
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
                                <div style="text-align:right;">
                                    <a href="{{ url('alliance') }}/{{ $value->id }}/{{ $name }}">รายละเอียดเพิ่มเติม
                                        <i class="fa fa-caret-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container" style="margin-bottom: 50px;">
        <center>
            <div class="header-title">
                <h2 style="margin-top:5rem;">
                    <strong>พันธมิตรที่ร่วมรายการ</strong>
                </h2>
            </div>
        </center><br>
        <div class="row alliance">
            <div class="col-md-3">
                <div class="card alliance-food">
                    <div class="card-body text-center centered-element">
                        <h3 class="text-center">Food And Drink</h3><br>
                        <a href="{{ url('alliance-foodanddrink') }}">สิทธิพิเศษ</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
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
            <div class="col-md-3">
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
            <div class="col-md-3">
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
        </div>
    </div>
    <form action="{{ url('/member/alliance-success') }}" enctype="multipart/form-data" method="post">@csrf
        @if ($balance_point > $partner_point || $balance_point == $partner_point)
            <div class="modal fade mobile" id="myModal" role="dialog">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="md-12">
                                @php
                                    $partner_name = DB::table('partner_shops')
                                        ->where('id', $partner_promotion->partner_id)
                                        ->value('name');
                                    $partner_branch = DB::table('partner_shops')
                                        ->where('id', $partner_promotion->partner_id)
                                        ->value('branch');
                                @endphp
                                <center>
                                    <h3 style="color:#092895 !important; font-weight:normal;">
                                        {{ $partner_name }} {{ $partner_branch }}
                                    </h3>
                                </center>
                                <center>
                                    <h3 style="color:#d85700 !important; font-weight:normal;" class="mt-3">ใช้คะแนนสะสม
                                        {{ $partner_point }} คะแนน</u></h3>
                                </center>
                                <div class="photo">
                                    <center><img src="{{ url('/images/partner') }}/{{ $partner_promotion->image }}"
                                            class="img-responsive mt-5 mb-5" width="80%" style="border-radius: 10px;">
                                    </center>
                                </div>
                                <center>
                                    <div class="description">
                                        <h4 style="color:#092895 !important; font-weight:normal;">คะแนนสะสม :
                                            {{ number_format($balance_point) }} points</h4>
                                        <?php
                                        $partner_point = $partner_point;
                                        $balancePoint = $balance_point - $partner_point;
                                        ?>
                                        <h4 style="color:#092895 !important; font-weight:normal;">คะแนนคงเหลือ :
                                            {{ number_format($balancePoint) }} points</h4>
                                    </div>
                                </center>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button style="font-family: 'Prompt' !important;" type="button" class="btn btn-danger"
                                data-dismiss="modal">ยกเลิก</button>
                            <input type="hidden" value="{{ $partner_promotion->id }}" name="id">
                            <button style="font-family: 'Prompt' !important;" type="submit"
                                class="btn btn-success">ใช้สิทธิพิเศษ</button>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="modal fade mobile" id="myModal" role="dialog">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h3 style="text-align: center; color:#F28123;" class="mt-5 mb-5">คะแนนสะสมไม่เพียงพอ</h3>
                        </div>
                        <div class="modal-footer">
                            <button style="font-family: 'Prompt' !important;" type="button" class="btn btn-danger"
                                data-dismiss="modal">ยกเลิก</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
@endsection
