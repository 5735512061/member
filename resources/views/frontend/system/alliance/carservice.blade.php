@extends('frontend/layouts/template')

@section('content')
    <div class="container" style="margin-bottom: 50px;">
        <center>
            <div class="header-title">
                <h2 style="margin-top:15rem;">
                    <strong>Car Service</strong>
                </h2>
            </div>
        </center>
        <br>
        <div class="latest-news mt-80 mb-150">
            <div class="row">
                @foreach ($partners as $partner => $value)
                    @php
                        $image = DB::table('partner_shops')->where('id',$value->partner_id)->value('image');
                        $name = DB::table('partner_shops')->where('id',$value->partner_id)->value('name');
                    @endphp
                    <div class="col-lg-4 col-md-6">
                        <div class="single-latest-news" style="background-color: #ffffff;">
                            <a href="{{ url('alliance') }}/{{ $value->id }}/{{ $name }}">
                                <img src="{{ url('images/partner') }}/{{ $image }}"
                                    class="latest-news-bg img-responsive" width="100%">
                            </a>
                            <div class="news-text-box">
                                <h1><a
                                        href="{{ url('alliance') }}/{{ $value->id }}/{{ $name }}">{{ $name }}</a>
                                </h1>
                                <div class="excerpt">{!! $value->promotion !!}</div>
                                <a href="{{ url('alliance') }}/{{ $value->id }}/{{ $name }}"
                                    class="read-more-btn">รายละเอียดเพิ่มเติม <i class="fa fa-caret-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
