@extends('frontend/layouts/template')

@section('content')
@php
    $partner = DB::table('partner_shops')->where('id',$promotion->partner_id)->value('name');
    $image = DB::table('partner_shops')->where('id',$promotion->partner_id)->value('image');
@endphp
    <div class="container" style="margin-bottom: 50px;">
        <center>
            <div class="header-title">
                <h1 style="margin-top:15rem; color: #f28123;">
                    <strong>ส่วนลดพิเศษในเครือพันธมิตร</strong>
                </h1>
            </div>
        </center>
        <br>
        <!-- single article section -->
        <div class="mt-100 mb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="single-article-section">
                            <div class="single-article-text">
                                <img src="{{ url('images/partner') }}/{{ $image }}" class="img-responsive"
                                    width="100%">
                                <h1 class="article-title">{{ $partner }}</h1>
                                <div class="article-detail">{!! $promotion->promotion !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end single article section -->
    </div>
@endsection
