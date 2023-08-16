@extends("frontend/layouts/template")

@section("content")
<div class="mt-150 mb-150">
    <div class="container">
        <div class="row justify-content-center mt-5"> 
            <div class="col-lg-4">
                <center><h3 style="color:#fff; border-bottom:3px solid #fff; margin-bottom:15px; width:70%;">เปลี่ยนเบอร์โทรศัพท์</h3></center>
                <form method="POST" action="{{url('/member/tel-update')}}" class="mt-5">@csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="text" name="tel" placeholder="เบอร์โทรศัพท์ใหม่" onfocus="this.placeholder = 'เบอร์โทรศัพท์ใหม่'" class="phone_format form-control" value="{{$member->tel}}">

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="hidden" name="id" value="{{$member->id}}">
                            <button type="submit" class="btn btn-lg btn-secondary btn-block">ยืนยันเบอร์โทรศัพท์ใหม่</button>
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
