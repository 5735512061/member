@extends('frontend/layouts/template')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>

<style>
@media only screen and (max-width: 768px) {
    #mobile {
      display: inline !important;
    }
    #desktop {
      display: none;
    }
}
.card {
	 position: absolute;
	 background: white;
	 margin: 0 auto;
	 box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
	 transition: all 0.3s;
}
 .card:hover {
	 box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
 .card nav {
	 width: 100%;
	 color: #727272;
	 padding: 20px;
	 border-bottom: 2px solid #efefef;
	 font-size: 12px;
}
 .card nav svg.heart {
	 height: 24px;
	 width: 24px;
	 float: right;
	 margin-top: -3px;
	 transition: all 0.3s ease;
	 cursor: pointer;
}
 .card nav svg.heart:hover {
	 fill: red;
}
 .card nav svg.arrow {
	 float: left;
	 height: 15px;
	 width: 15px;
	 margin-right: 10px;
}
  .card .photo {
	 padding: 30px;
	 width: 30%;
	 text-align: center;
	 float: left;
}
  .card .photo img {
	 max-height: 240px;
}
  .card .description {
	 padding: 30px;
	 float: left;
	 width: 55%;
	 border-left: 2px solid #efefef;
}
  .card .description h1 {
	 color: #515151;
	 font-weight: 300;
	 padding-top: 15px;
	 margin: 0;
	 font-size: 30px;
     font-weight: 300;
     text-align: left !important;
}
  .card .description h2 {
	 color: #515151;
	 margin: 0;
	 text-transform: uppercase;
	 font-weight: 500;
}
  .card .description h4 {
	 margin: 0;
	 color: #727272;
	 text-transform: uppercase;
	 font-weight: 500;
	 font-size: 12px;
}

    .card .description h3 {
	 margin: 0;
	 color: #727272;
	 font-weight: 500;
	 font-size: 18px;
}

  .card .description p {
	 font-size: 12px;
	 line-height: 20px;
	 color: #727272;
	 padding: 20px 0;
	 margin: 0;
}
 
</style>
@section("content")
@php
    $redeem_reward_point = 0;
    $sumpoint = 0;
    $redeem_point_sum = 0;
    $balance_point = 0;
@endphp

{{-- point ที่ได้รับ --}}
@foreach ($points as $point => $value)
    @php
        $price = floor(($value->price)/100); 
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

<div class="container">
    <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-4 col-12" style="text-align: right;">
                <h4 style="color: #2b3282;" class="large-6 column">
                    คะแนนสะสม
                </h4>
                <h4 style="color: #000000;" class="large-6 column">
                    {{number_format($balance_point)}} points
                </h4>
        </div>
    </div><br>
</div>
@php
    $point = DB::table('reward_points')->where('reward_id',$reward->id)->orderBy('id','desc')->value('point');
 @endphp
<div class="container" id="desktop">
    <div class="row">
        <div class="card">
            <div class="md-12">
                <nav><h2 style="color:#092895 !important; font-weight:normal;">{{$reward->reward_name}}</h2></nav>
                <div class="photo">
                    <center><img src="{{url('/images/reward')}}/{{$reward->image}}" class="img-responsive" width="100%"></center>
                </div>
                <div class="description">
                    <h3>รายละเอียด : {{$reward->detail}}</h3>
                    <h1 style="color:#d85700 !important;">ใช้คะแนนสะสม {{$point}} คะแนน</h1>
                    <h1 style="font-size:20px;">เงื่อนไขการรับสิทธิ์</h1>
                    <div style="font-family: 'Prompt';">
                        <img src="{{ asset('/img/mycare/symbol/arrow.png')}}" width="4%">กดแลกพอยท์ทางเว็บไซต์เพื่อรับสิทธิ์<br>
                        <img src="{{ asset('/img/mycare/symbol/arrow.png')}}" width="4%">ทางบริษัทฯ จะติดต่อกลับเพื่อให้ท่านยืนยันการรับสิทธิ์<br>
                        <img src="{{ asset('/img/mycare/symbol/arrow.png')}}" width="4%">กรณีทำการแลกพอยท์แล้ว จะไม่สามารถยกเลิกได้ทุกกรณี<br><br>
                    </div>
                    <button class="genric-btn blue radius btn_sub" style="width: 70%;" data-toggle="modal" data-target="#myModal">กดแลกคะแนนสะสม</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container" id="mobile" style="display: none;">
	<div class="row" style="margin-top:-20px !important;">
		<div class="card" style="margin:3rem !important; border: 2px solid rgba(0, 0, 0, .125) !important; margin-top:0px !important; margin-bottom:0.5rem !important; width: 22rem;">
		  <nav><h2 style="color:#092895 !important; font-weight:normal; text-align:center;">{{$reward->reward_name}}</h2></nav>
		  <div class="card-body" style="padding: 1rem !important;">
			<p><a href="#" style="border-bottom: 3px solid blue;">รายละเอียด</a></p><p>{{$reward->detail}}</p>
			<h3 class="card-title" style="color:#d85700; font-size:22px; font-weight:normal;">ใช้คะแนน {{$point}} Point</h3>
			<center><img src="{{url('/images/reward')}}/{{$reward->image}}" class="img-responsive" width="80%"></center>
			<h1 style="font-size:20px; margin-top:0px !important;">เงื่อนไขการรับสิทธิ์</h1>
                    <div style="font-family: 'Prompt';">
                        <img src="{{ asset('/img/mycare/symbol/arrow.png')}}" width="7%">กดแลกคะแนนสะสมเพื่อรับสิทธิ์<br>
                        <img src="{{ asset('/img/mycare/symbol/arrow.png')}}" width="7%">ทางบริษัทฯ จะติดต่อกลับเพื่อให้ท่านยืนยันการรับสิทธิ์<br>
                        <img src="{{ asset('/img/mycare/symbol/arrow.png')}}" width="7%">กรณีทำการแลกพอยท์แล้ว จะไม่สามารถยกเลิกได้ทุกกรณี<br><br>
                    </div>
            <button class="genric-btn blue radius btn_sub" style="width: 70%;" data-toggle="modal" data-target="#myModal">แลกคะแนนสะสม</button>
		  </div>
		</div>
	</div>
</div>
<form action="{{url('/member/reward-success')}}" enctype="multipart/form-data" method="post">@csrf
@if($balance_point > $point || $balance_point == $point)
<div class="modal fade mobile" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">
                    <div class="md-12">
                        <center><h3 style="color:#092895 !important; font-weight:normal;">{{$reward->reward_name}}</h3></center>
                        <center><h3 style="color:#d85700 !important; font-weight:normal;">ใช้คะแนนสะสม {{$point}} คะแนน</u></h3></center>
                        <div class="photo">
                            <center><img src="{{url('/images/reward')}}/{{$reward->image}}" class="img-responsive" width="50%"></center>
                        </div>
                        <center>
                        <div class="description">
                            <h4 style="color:#092895 !important; font-weight:normal;">คะแนนสะสม : {{number_format($balance_point)}} points</h4>
                            <?php 
                                $reward_point = $point;
                                $balancePoint = $balance_point - $reward_point;
                            ?>
                            <h4 style="color:#092895 !important; font-weight:normal;">คะแนนคงเหลือ : {{number_format($balancePoint)}} points</h4>
                        </div>
                        </center>
                    </div>
            </div>
            <div class="modal-footer">
                <button style="font-family: 'Prompt' !important;" type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                <input type="hidden" value="{{$reward->id}}" name="id">
                <button style="font-family: 'Prompt' !important;" type="submit" class="btn btn-success">แลกพอยท์</button>
            </div>
        </div>
    </div>
</div>
@else
<div class="modal fade mobile" id="myModal" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">
        <p style="text-align: center;">คะแนนสะสมไม่เพียงพอ</p>
      </div>
      <div class="modal-footer">
        <button style="font-family: 'Prompt' !important;" type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
@endif
</form>
@endsection