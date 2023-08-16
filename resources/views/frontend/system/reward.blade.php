@extends('frontend/layouts/template')

@section('content')
    <div class="container" style="margin-bottom: 50px;">
        <center>
            <div class="header-title">
                <h2 style="margin-top:15rem;">
                    <strong>ของรางวัล</strong>
                </h2>
            </div>
        </center>
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
                            <div class="col-md-3">
                                <div class="card mt-5">
                                    <div class="card-body">
                                        <img src="{{ url('images/reward') }}/{{ $value->image }}" class="img-responsive"
                                            width="100%">
                                        <p class="mb-0 mt-4">
                                            {{ $value->name }}</p>
                                        <p class="mb-3">ใช้พอยท์ <i class="fa fa-caret-right" style="color:#777777;"></i>
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
            <h1 style="text-align: center;">-- Coming Soon --</h1>
        @endif
    </div>
@endsection
