@extends("backend/layouts/adminStore/template")
<style>
    .member-profile a{
        color: #ffffff;
    }
    .member-profile a:hover{
        color: #ffffff;
    }
    .vertical-center {
        margin: 0;
        position: absolute;
        top: 50%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
    }
    .card span{
        font-size: 30px;
        color: red;
        font-weight: bold;
    }

    .card-header a {
        color: #1300c2;
    }
    .card-header a:hover{
        color: #471de0;
    }
</style>
@section("content")
@php
    $sumprice = DB::table('points')->where('member_id',$member->id)->sum('price');
    $point_balance = floor(($sumprice)/100);
@endphp
<div class="container-fluid py-4">
    <div class="member-profile">
        <div class="row">   
            <div class="col-lg-5 mb-lg-0 mb-4">
                <a href="javascript:history.back();"><i class="ni ni-bold-left"></i> ย้อนกลับ</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8 mt-4 mb-lg-0 mb-4">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                    @endif
                @endforeach
                <div class="card z-index-2">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <center><img src="{{url('assets/image/profile.png')}}" width="70%;"></center>
                            </div>
                            @php
                                $member_new = count(DB::table('members')->where('id',$member->id)->where('created_at','>', now()->subDays(30)->endOfDay())->get());
                            @endphp
                            <div class="col-md-4" style="border-right: 2px dashed #9e9e9e;">

                                @if($member->status == "ONLINE")
                                    <button class="btn btn-success btn-sm my-auto" style="color:#fff;">
                                        {{$member->status}}
                                    </button>
                                @else 
                                    <button class="btn btn-danger btn-sm my-auto" style="color:#fff;">
                                        {{$member->status}}
                                    </button>
                                @endif
                                @if($member_new != 0)
                                <button class="btn btn-warning btn-sm my-auto" style="color:#fff;">ลูกค้าใหม่</button>
                            @endif
                                <h5 class="mt-2">หมายเลขสมาชิก <i class="fa fa-caret-down" style="color:#777777;"></i><br>{{$member->serialnumber}}</h5>
                                <h4>คุณ{{$member->name}} {{$member->surname}}</h4>
                                
                                @if($sumprice == 0 || $sumprice < 100001)
                                    <h5 class="mt-3">ระดับของสมาชิก <i class="fa fa-caret-down" style="color:#777777;"></i><br>SILVER</h5><br>
                                @elseif($sumprice == 100001 || $sumprice < 500001)
                                    <h5 class="mt-3">ระดับของสมาชิก <i class="fa fa-caret-down" style="color:#777777;"></i><br>GOLD</h5><br>
                                @elseif($sumprice == 500001 || $sumprice < 1000001)
                                    <h5 class="mt-3">ระดับของสมาชิก <i class="fa fa-caret-down" style="color:#777777;"></i><br>PLATINAM</h5><br>
                                @elseif($sumprice > 1000001)
                                    <h5 class="mt-3">ระดับของสมาชิก <i class="fa fa-caret-down" style="color:#777777;"></i><br>DIAMOND</h5><br>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <h4 class="mb-1">พอยท์คงเหลือ <i class="fa fa-caret-down" style="color:#777777;"></i><br><span> {{$point_balance}} </span>พอยท์</h4>
                                <h5 class="mb-1">เบอร์โทรศัพท์ <i class="fa fa-caret-right" style="color:#777777;"></i> {{$member->tel}}</h5>
                                <h5>วัน/เดือน/ปีเกิด <i class="fa fa-caret-right" style="color:#777777;"></i> {{$member->bday}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8 mt-4 mb-lg-0 mb-4">
                <div class="card z-index-2">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <div class="table-responsive">
                            <table class="table align-items-center">
                                <thead class="thead-light">
                                  <tr style="text-align: center;">
                                    <th>ลำดับ</th>
                                    <th>วันที่</th>
                                    <th>สาขา</th>
                                    <th>หมายเลขบิล</th>
                                    <th>จำนวนเงิน</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($points as $point => $value)
                                        @php
                                            $store_name = DB::table('account_stores')->where('id',$value->branch_id)->value('store_name');
                                            $branch = DB::table('account_stores')->where('id',$value->branch_id)->value('branch');
                                        @endphp
                                        <tr style="text-align:center;">
                                            <td>{{$NUM_PAGE*($page-1) + $point+1}}</td>
                                            <td>{{$value->date}}</td>
                                            <td>{{$store_name}} {{$branch}}</td>
                                            <td>{{$value->bill_number}}</td>
                                            <td>{{$value->price}}</td>
                                        </tr>
                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>
</div>
@endsection