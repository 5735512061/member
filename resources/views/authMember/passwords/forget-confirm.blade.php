@extends("frontend/layouts/template")

@section("content")
<div class="mt-150 mb-150">
    <div class="container">
        <div class="row justify-content-center mt-5"> 
            <div class="col-lg-4" style="color:#fff; margin-left:15px;">
                <h3 style="color:#e57d0d;">ตั้งรหัสผ่านใหม่</h3>
                <form method="POST" action="{{ route('password.updateForget') }}">@csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input id="password" type="password" name="password" placeholder="ป้อนรหัสผ่านใหม่" onfocus="this.placeholder = 'ป้อนรหัสผ่านใหม่'" class="form-control" required autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                        <input id="password-confirm" type="password" name="password_confirmation" placeholder="ยืนยันรหัสผ่านอีกครั้ง" onfocus="this.placeholder = 'ยืนยันรหัสผ่านอีกครั้ง'" class="form-control" required autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="hidden" name="card_id" value="{{$card_id}}">
                            <input type="hidden" name="tel" value="{{$tel}}">
                            <button type="submit" class="btn btn-lg btn-secondary btn-block">ตั้งรหัสผ่านใหม่</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
