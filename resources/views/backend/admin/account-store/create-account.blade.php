@extends("backend/layouts/admin/template")
<style>
  .account p {
    font-weight: bolder;
  }

  .account span {
    color: rgba(253, 48, 48, 0.699);
    font-size: 14px;
  }
</style>
@section("content")
<div class="container-fluid py-4">
  <div class="row">   
    <div class="col-lg-5 mb-lg-0 mb-4">
        <a href="javascript:history.back();" style="color:#fff;"><i class="ni ni-bold-left"></i> ย้อนกลับ</a>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-lg-2 mb-lg-0 mb-4"></div>
    <div class="col-lg-8 mb-lg-0 mb-4">
      <div class="card z-index-2 h-100">
        <div class="flash-message">
          @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

            <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
            @endif
          @endforeach
        </div>
        <div class="card-header pb-0 pt-5 bg-transparent center" style="font-size: 28px;">
          กรอกข้อมูลสำหรับการสร้างร้านค้า
        </div>
        <form action="{{url('/create-account-store')}}" enctype="multipart/form-data" method="post">@csrf
        <div class="card-body">
          <div class="account">
            <div class="row">
              <div class="col-md-12">
                <p><span>*</span> ชื่อร้านค้า <span>(จำเป็นต้องกรอก)</span></p>
                <input class="form-control" type="text" placeholder="ชื่อร้านค้า" name="store_name">
              </div>
            </div>
            <div class="row"><p class="mt-2"><span>*</span><span> (จำเป็นต้องกรอก)</span></p></div>
            <div id="show_item">
              <div class="row">
                <div class="col-md-5 col-9 mt-2">
                  <input class="form-control" type="text" placeholder="สาขา เช่น บายพาส" name="inputs[0][branch]">
                </div>
                <div class="col-md-5 col-9 mt-2">
                  <input class="phone_format form-control" type="text" placeholder="เบอร์โทรศัพท์" name="inputs[0][tel]">
                </div>
                <div class="col-md-5 col-9 mt-2">
                  <input class="form-control" type="text" placeholder="ชื่อเข้าใช้งาน" name="inputs[0][username]">
                </div>
                <div class="col-md-5 col-9 mt-2">
                  <input class="form-control" type="password" placeholder="รหัสผ่าน" name="inputs[0][password_name]">
                </div>
                <div class="col-md-2 col-2 mt-2" id="button">
                  <button type="button" class="btn btn-info add_item_btn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-lg btn-success">สร้างร้านค้า</button>
              </div>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>
    <div class="col-lg-2 mb-lg-0 mb-4"></div>
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

  var i = 0;
  $(document).ready(function( ){
    $('.add_item_btn').on('click',function(e) {
      e.preventDefault(); 
      ++i;
      $("#show_item").append('<div class="row"><div class="col-md-5 col-9 mt-2"><input class="form-control" type="text" placeholder="สาขา เช่น บายพาส" name="inputs['+i+'][branch]"></div><div class="col-md-5 col-9 mt-2"><input class="form-control" type="text" placeholder="เบอร์โทรศัพท์" name="inputs['+i+'][tel]"></div><div class="col-md-5 col-9 mt-2"><input class="form-control" type="text" placeholder="ชื่อเข้าใช้งาน" name="inputs['+i+'][username]"></div><div class="col-md-5 col-9 mt-2"><input class="form-control" type="password" placeholder="รหัสผ่าน" name="inputs['+i+'][password_name]"></div><div class="col-md-1 col-1 mt-2"><button type="button" class="btn btn-danger remove_item_btn">X</button></div></div>')
    });

    $(document).on('click', '.remove_item_btn', function(e){
      e.preventDefault();
      let row_item = $(this).parent().parent();
      $(row_item).remove();
    });
  });

</script>
@endsection