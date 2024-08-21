@extends('frontend/layouts/template')

@section('content')
    <div style="background-color:#f0b6b5;">
        <div class="container" style="padding-bottom: 50px;">
            <center>
                <div class="header-title">
                    <h2 style="padding-top:5rem; color: #2e5b55;">
                        <strong>บทความ อาหาร</strong>
                    </h2>
                </div>
            </center>
            <br>
            <div class="latest-news mt-80">
                <div style="margin-bottom: 2rem;">
                    <a href="{{ url('allarticle') }}" class="btn btn-secondary" style="margin-right: 1rem;">ทั้งหมด</a>
                    <a href="{{ url('article/food') }}" class="btn btn-secondary" style="margin-right: 1rem;">บทความ
                        อาหาร</a>
                    <a href="{{ url('article/lifeStyle') }}" class="btn btn-secondary" style="margin-right: 1rem;">บทความ
                        ไลฟ์สไตล์</a>
                    <a href="{{ url('article/beauty') }}" class="btn btn-secondary" style="margin-right: 1rem;">บทความ
                        บิวตี้</a>
                    <a href="{{ url('article/news') }}" class="btn btn-secondary" style="margin-right: 1rem;">บทความ
                        ข่าว</a>
                    <a href="{{ url('article/horoscope') }}" class="btn btn-secondary" style="margin-right: 1rem;">บทความ
                        ดูดวง</a>
                    <a href="{{ url('article/general') }}" class="btn btn-secondary" style="margin-right: 1rem;">บทความ
                        ทั่วไป</a>
                </div>
                <div class="row">
                    @foreach ($articles as $article => $value)
                        <div class="col-lg-4 col-md-6">
                            <div class="single-latest-news" style="background-color: #ffffff;">
                                <a href="{{ url('article') }}/{{ $value->id }}/{{ $value->title }}">
                                    <img src="{{ url('images/article') }}/{{ $value->image }}"
                                        class="latest-news-bg img-responsive" width="100%">
                                </a>
                                <div class="news-text-box">
                                    <h1><a
                                            href="{{ url('article') }}/{{ $value->id }}/{{ $value->title }}">{{ $value->title }}</a>
                                    </h1>
                                    <p class="blog-meta">
                                        <span>บทความ{{ $value->type }}</span>
                                    </p>
                                    <div class="excerpt">{!! $value->article !!}</div>
                                    <a href="{{ url('article') }}/{{ $value->id }}/{{ $value->title }}"
                                        class="read-more-btn">read more <i class="fa fa-caret-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
