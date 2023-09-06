@extends("backend/layouts/admin/template")
<style>
    .campaign h4{
        color: #fff;
        border-bottom: 2px solid #eeeeee;
        padding-bottom: 15px;
    }
    .campaign h3{
        color: #a7a7a7e1;
    }
    .campaign p{
        font-size: 16px;
    }
    .campaign span{
        font-size: 14px;
        color: red;
        font-weight:500;
    }

    .campaign a{
        color: #ffffff;
    }

    .campaign a:hover{
        color: #ffffff;
    }

    .img-area {
        position: relative;
        width: 100%;
        height: 240px;
        background: #e4e4e4;
        margin-bottom: 20px;
        border-radius: 15px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;  
        flex-direction: column;
        
    }

    .img-area .icon {
        font-size: 50px;
    }

    .img-area img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        z-index: 100;
    }

    .img-area::before {
        content: attr(data-img);
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, .5);
        color: #fff;
        font-weight: 500;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        pointer-events: none;
        opacity: 0;
        transition: all .3s easeว
    }

    .img-area.active:hover::before {
        opacity: 1;
    }

    .select-image{
        display: block;
        width: 100%;
        padding: 12px 0;
        border-radius: 15px;
        background: #1229f5;
        color: #fff;
        font-weight: 500;
        font-size: 16px;
        border: none;
        cursor: pointer;
        transition: all .3s ease;
        z-index: 200;
    }

    .select-image:hover {
        background: #3939eb;
    }
</style>
@section("content")
<div class="container-fluid py-4">
    <div class="campaign">
        <div class="row">   
            <div class="col-lg-5 mb-lg-0 mb-4">
                <a href="javascript:history.back();"><i class="ni ni-bold-left"></i> ย้อนกลับ</a>
            </div>
        </div>
        <h4 class="mt-4">เพิ่มเครือข่ายพันธมิตร</h4>
        <div class="row mt-4">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                            <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                        @endif
                    @endforeach
                </div>
                <form action="{{url('create-partner')}}" enctype="multipart/form-data" method="post">@csrf
                    <div class="row">
                        <div class="offset-2 col-md-8">
                            <div class="card z-index-2">
                                <div class="card-header pb-0 pt-3 bg-transparent">
                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <p><span>*</span> ชื่อพันธมิตร <span>(จำเป็นต้องกรอก)</span>
                                                @if ($errors->has('name'))
                                                    <span class="text-danger" style="font-size: 15px;">({{ $errors->first('name') }})</span>
                                                @endif
                                            </p>
                                            <input class="form-control" type="text" placeholder="กรุณากรอกชื่อพันธมิตร" name="name">
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <p><span>*</span> เบอร์โทรศัพท์ <span>(จำเป็นต้องกรอก)</span>
                                                @if ($errors->has('tel'))
                                                    <span class="text-danger" style="font-size: 15px;">({{ $errors->first('tel') }})</span>
                                                @endif
                                            </p>
                                            <input type="text" name="tel" placeholder="กรุณากรอกเบอร์โทรศัพท์" class="phone_format form-control">
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <p><span>*</span> ประเภทพันธมิตร <span>(จำเป็นต้องกรอก)</span></p>
                                            <select name="type" class="form-control">
                                                <option value="Food And Drink">Food And Drink</option>
                                                <option value="Life Style">Life Style</option>
                                                <option value="Travel">Travel</option>
                                                <option value="Car Service">Car Service</option>
                                            </select> 
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <p>สถานะ</p>
                                            <select name="status" class="form-control">
                                                <option value="เปิด">เปิด</option>
                                                <option value="ปิด">ปิด</option>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mt-3">
                                            <button type="submit" class="btn btn-lg btn-success">เพิ่มเครือข่ายพันธมิตร</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>  
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    // number phone
    function phoneFormatter() {
        $('input.phone_format').on('input', function() {
            var number = $(this).val().replace(/[^\d]/g, '')
                if (number.length >= 5 && number.length < 10) { number = number.replace(/(\d{3})(\d{2})/, "$1-$2"); } else if (number.length >= 10) {
                    number = number.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3"); 
                }
            $(this).val(number)
            $('input.phone_format').attr({ maxLength : 12 });
        });
    };
    $(phoneFormatter);
</script>
@endsection