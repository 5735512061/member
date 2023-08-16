@extends("backend/layouts/staff/template")
<style>
  .account p {
    font-weight: 600;
    font-size: 16px;
  }

  .account span {
    color: rgba(253, 48, 48, 0.699);
    font-size: 14px;
  }
  .account h4{
    color: #fff;
  }

  .account h3{
    font-size: 26px;
  }

  .header h4{
    color: #fff;
    border-bottom: 2px solid #eeeeee;
    padding-bottom: 15px;
  }
</style>
@section("content")
<div class="container-fluid py-4">
  <div class="header">
    <h4>สมัครสมาชิกใหม่</h4>
  </div>
  <div class="account">
  <div class="row mt-4">
    <div class="col-lg-3 mb-lg-0 mb-4"></div>
    <div class="col-lg-6 mb-lg-0 mb-4">
      <div class="card z-index-2 h-100">
        <form action="{{url('staff/register-member')}}" enctype="multipart/form-data" method="post">@csrf
        <div class="card-body">
            <div class="flash-message">
              @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))

                <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                @endif
              @endforeach
            </div>
            <h3>ข้อมูลผู้สมัครสมาชิก <i class="fa fa-caret-down" style="color:#777777;"></i></h3>
            <div class="row">
              <div class="col-md-2 mt-4">
                <p>คำนำหน้า <i class="fa fa-caret-right" style="color:#777777;"></i></p>
              </div>
              <div class="col-md-3 mt-3">
                <select name="title" class="form-control">
                  <option value="นาย">นาย</option>
                  <option value="นาง">นาง</option>
                  <option value="นางสาว">นางสาว</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mt-2">
                <p>
                  <span>*</span> หมายเลขบัตรประชาชน <i class="fa fa-caret-down" style="color:#777777;"></i>
                  @if ($errors->has('card_id'))
                    <span class="text-danger" style="font-size: 15px;">({{ $errors->first('card_id') }})</span>
                  @endif
                </p>
                <input class="form-control" type="text" placeholder="กรอกหมายเลขบัตรประชาชน" name="card_id">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mt-2">
                <p>
                  <span>*</span> ชื่อ ตามบัตรประชาชน <i class="fa fa-caret-down" style="color:#777777;"></i>
                  @if ($errors->has('name'))
                    <span class="text-danger" style="font-size: 15px;">({{ $errors->first('name') }})</span>
                  @endif
                </p>
                <input class="form-control" type="text" placeholder="กรอกชื่อ ตามบัตรประชาชน" name="name">
              </div>
              <div class="col-md-6 mt-2">
                <p>
                  <span>*</span> นามสกุล ตามบัตรประชาชน <i class="fa fa-caret-down" style="color:#777777;"></i>
                  @if ($errors->has('surname'))
                    <span class="text-danger" style="font-size: 15px;">({{ $errors->first('surname') }})</span>
                  @endif
                </p>
                <input class="form-control" type="text" placeholder="กรอกนามสกุล ตามบัตรประชาชน" name="surname">
              </div>
              <div class="col-md-6 mt-2">
                <p>
                  <span>*</span> วัน/เดือน/ปี ค.ศ เกิด <i class="fa fa-caret-down" style="color:#777777;"></i>
                  @if ($errors->has('bday'))
                    <span class="text-danger" style="font-size: 15px;">({{ $errors->first('bday') }})</span>
                  @endif
                </p>
                <input class="form-control" type="text" placeholder="กรอกวัน/เดือน/ปี ค.ศ เกิด" name="bday">
              </div>
              <div class="col-md-6 mt-2">
                <p>
                  <span>*</span> เบอร์โทรศัพท์ <i class="fa fa-caret-down" style="color:#777777;"></i>
                  @if ($errors->has('tel'))
                    <span class="text-danger" style="font-size: 15px;">({{ $errors->first('tel') }})</span>
                  @endif
                </p>
                <input class="phone_format form-control" type="text" placeholder="กรอกเบอร์โทรศัพท์" name="tel">
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 mt-3">
                <input type="hidden" name="status" value="ONLINE">
                <button type="submit" class="btn btn-lg btn-success">สมัครสมาชิกใหม่</button>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
    <div class="col-lg-3 mb-lg-0 mb-4"></div>
  </div>
    </div>
</div>

<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>  

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