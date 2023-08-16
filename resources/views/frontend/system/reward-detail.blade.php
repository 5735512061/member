@extends('frontend/layouts/template')

@section('content')
    @php
        $reward_point = DB::table('reward_points')
            ->where('reward_id', $reward->id)
            ->value('point');
    @endphp
    <div class="container" style="margin-bottom: 50px; margin-top: 15rem;">
        <div class="row">
            <div class="col-md-4">
                <center>
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ url('images/reward') }}/{{ $reward->image }}" class="img-responsive"
                                width="100%">
                        </div>
                    </div>
                </center>
            </div>
            <div class="col-md-8">
                <h2 style="color:#ffffff;">
                    <strong>{{ $reward->name }}</strong>
                </h2>
                <h3 class="mb-3">ใช้พอยท์ <i class="fa fa-caret-right" style="color:#777777;"></i>
                    <span>{{ $reward_point }}</span> พอยท์
                </h3>
                <h5>เงื่อนไขการแลกคะแนนสะสม</h5>
                <a href="{{url('member/reward-redem/')}}/{{$reward->id}}" class="btn btn-outline-primary radius-15" style="color: #ffffff;">กดแลกคะแนนสะสม</a>
            </div>
        </div>
    </div>
@endsection
