@extends("frontend/layouts/template")

@section("content")
<div class="mt-150 mb-150">
    <div class="container">
        <div class="row justify-content-center mt-5"> 
            <center>
                <h3 style="color:#e57d0d;">เข้าสู่ระบบ <br> สมาชิก</h3>
                <hr style="border-bottom:2px solid #fff;">
                <a href="{{route('password.forget')}}"><p style="color: #fff;">ลืมรหัสผ่าน ?</p></a>
            </center>
            <div class="col-lg-4" style="color:#fff; border-left:3px solid #fff; margin-left:15px;">
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                            <div class="alert alert-{{ $msg }}" role="alert">{{ Session::get('alert-' . $msg) }}</div>
                        @endif
                    @endforeach
                </div>
                <form method="POST" action="{{ route('member.login.submit') }}">@csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="text" placeholder="เบอร์โทรศัพท์" name="tel" class="phone_format form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="password" placeholder="รหัสผ่าน" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-lg btn-secondary btn-block">เข้าสู่ระบบ</button>
                        </div>
                    </div>
                </form>
            </div>
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
