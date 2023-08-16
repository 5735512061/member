@extends('frontend/layouts/template')

@section('content')
<div class="mt-150 mb-150">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-4">
                <center><h3 style="color:#fff; border-bottom:3px solid #fff; margin-bottom:15px; width:53%;">เปลี่ยนรหัสผ่าน</h3></center>
                <form method="POST" action="{{ route('password.update') }}" class="mt-5">@csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input id="oldpassword" type="password" class="form-control single-input{{ $errors->has('oldpassword') ? ' is-invalid' : '' }}" placeholder="รหัสผ่านเก่า" onfocus="this.placeholder = 'รหัสผ่านเก่า'" name="oldpassword" required autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input id="password" type="password" name="password" placeholder="รหัสผ่านใหม่" onfocus="this.placeholder = 'รหัสผ่านใหม่'" class="form-control single-input{{ $errors->has('password') ? ' is-invalid' : '' }}" required autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input id="password-confirm" type="password" name="password_confirmation" placeholder="ยืนยันรหัสผ่านอีกครั้ง" onfocus="this.placeholder = 'ยืนยันรหัสผ่านอีกครั้ง'" class="form-control single-input{{ $errors->has('password-confirm') ? ' is-invalid' : '' }}" required autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-lg btn-secondary btn-block">เปลี่ยนรหัสผ่าน</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
