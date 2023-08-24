@extends('backend/layouts/admin/template')
<style>
    .campaign h4 {
        color: #fff;
        border-bottom: 2px solid #eeeeee;
        padding-bottom: 15px;
    }

    .campaign h3 {
        color: #a7a7a7e1;
    }

    .campaign p {
        font-size: 14px;
    }

    .campaign span {
        font-size: 14px;
        color: red;
        font-weight: bold;
    }
</style>
@section('content')
    <div class="container-fluid py-4">
        <div class="campaign">
            <h4>แคมเปญ</h4>
        </div>
        <a href="{{ url('/create-campaign') }}" class="btn btn-success mt-5" type="submit"><i class="fa fa-plus-circle"
                aria-hidden="true"></i> สร้างแคมเปญ</a><br>
        <a href="{{ url('/campaign') }}" class="btn btn-secondary mt-5" type="submit"><i class="fa fa-ticket"
                aria-hidden="true"></i> แคมเปญทั้งหมด</a>
        <a href="{{ url('/campaign-on') }}" class="btn btn-success mt-5" type="submit"><i class="fa fa-play-circle"
                aria-hidden="true"></i> กำลังจัดแคมเปญ</a>
        <a href="{{ url('/campaign-notActive') }}" class="btn btn-info mt-5" type="submit"><i class="fa fa-pause"
                aria-hidden="true"></i> ยังไม่เริ่มแคมเปญ</a>
        <a href="{{ url('/campaign-pause') }}" class="btn btn-warning mt-5" type="submit"><i
                class="fa fa-exclamation-circle" aria-hidden="true"></i> แคมเปญถูกพัก</a>
        <a href="{{ url('/campaign-off') }}" class="btn btn-danger mt-5" type="submit"><i class="fa fa-ban"
                aria-hidden="true"></i> สิ้นสุดแคมเปญ</a>
    </div>
    <div class="container-fluid py-4">
        <div class="campaign">
            <div class="row">
                <div class="col-lg-12 mb-lg-0 mb-4">
                    <div class="z-index-2 h-100">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($campaigns as $campaign => $value)
                                    @php
                                        $store_name = DB::table('partner_shops')
                                            ->where('id', $value->partner_id)
                                            ->value('name');
                                    @endphp
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <img src="{{ url('images/campaign') }}/{{ $value->image }}"
                                                    class="img-responsive" width="100%">
                                                <p class="mb-0 mt-4">รหัสคูปอง <i class="fa fa-caret-right"
                                                        style="color:#777777;"></i> {{ $value->code }}</p>
                                                <p class="mb-0 mt-2 mb-3" style="border-bottom: 2px dashed #cac8c8;">
                                                    {{ $value->name }}</p>
                                                @if ($value->campaign_type == 'ไม่ระบุ')
                                                    <p>ประเภทคูปอง <i class="fa fa-caret-right" style="color:#777777;"></i>
                                                        {{ $value->campaign_type }} <span>(คูปองทั่วไป)</span></p>
                                                @else
                                                    <p>ประเภทคูปอง <i class="fa fa-caret-right" style="color:#777777;"></i>
                                                        {{ $value->campaign_type }}</p>
                                                @endif
                                                <p style="border-bottom: 2px dashed #cac8c8;">สถานะ <i
                                                        class="fa fa-caret-right" style="color:#777777;"></i>
                                                        {{ $value->status }}
                                                </p>

                                                @if ($store_name == 'ไม่ระบุ')
                                                    <p>ใช้ได้ที่ <i class="fa fa-caret-right" style="color:#777777;"></i>
                                                        {{ $store_name }} <span>(ใช้ได้ทุกร้านในเครือ)</span></p>
                                                @else
                                                    <p>ใช้ได้ที่ <i class="fa fa-caret-right" style="color:#777777;"></i>
                                                        {{ $store_name }}
                                                @endif
                                                <p>ระยะเวลา <i class="fa fa-caret-right" style="color:#777777;"></i>
                                                    {{ $value->start_date }} - {{ $value->expire_date }}</p>
                                                <div class="col" style="text-align: right;">
                                                    <a href="{{url('campaign-edit/')}}/{{$value->id}}" class="btn btn-outline-primary radius-15"><i
                                                            class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    <a href="#" class="btn btn-outline-primary radius-15"><i
                                                            class="fa fa-trash" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
