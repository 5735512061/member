@extends('frontend/layouts/template')

@section('content')
    @php
        $articles = DB::table('articles')
            ->where('id', '!=', $article->id)
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
    @endphp
    <div class="container" style="margin-bottom: 50px;">
        <center>
            <div class="header-title">
                <h1 style="margin-top:15rem; color: #f28123;">
                    <strong>{{ $article->title }}</strong>
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
                                <img src="{{ url('images/article') }}/{{ $article->image }}" class="img-responsive"
                                    width="100%">
                                <h1 class="article-title">{{ $article->title }}</h1>
                                <div class="article-detail">{!! $article->article !!}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="sidebar-section">
                            <div class="recent-posts">
                                <h4>Recent Posts</h4>
                                <ul>
                                    @foreach ($articles as $article => $value)
                                        <li><a
                                                href="{{ url('article') }}/{{ $value->id }}/{{ $value->title }}">{{ $value->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tag-section">
                                <h4>Tags</h4>
                                <ul>
                                    <li><a href="{{ url('article/food') }}">บทความ อาหาร</a></li>
                                    <li><a href="{{ url('article/lifeStyle') }}">บทความ ไลฟ์สไตล์</a></li>
                                    <li><a href="{{ url('article/beauty') }}">บทความ บิวตี้</a></li>
                                    <li><a href="{{ url('article/news') }}">บทความ ข่าว</a></li>
                                    <li><a href="{{ url('article/horoscope') }}">บทความ ดูดวง</a></li>
                                    <li><a href="{{ url('article/general') }}">บทความ ทั่วไป</a></li>
                                </ul>
                            </div>
                            <h4>Others Posts</h4>
                            <div class="latest-news">
                                @foreach ($articles as $article => $value)
                                    <div class="single-latest-news" style="background-color: #ffffff;">
                                        <a href="{{ url('article') }}/{{ $value->id }}/{{ $value->title }}">
                                            <img src="{{ url('images/article') }}/{{ $value->image }}"
                                                class="img-responsive" width="100%">
                                        </a>
                                        <div class="news-text-box">
                                            <h1><a
                                                    href="{{ url('article') }}/{{ $value->id }}/{{ $value->title }}">{{ $value->title }}</a>
                                            </h1>
                                            <div class="excerpt" style="-webkit-line-clamp: 2 !important;">{!! $value->article !!}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end single article section -->
    </div>
@endsection
