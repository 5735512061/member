@extends('frontend/layouts/template')

@section('content')
    <div class="container" style="margin-bottom: 50px;">
        <center>
            <div class="header-title">
                <h2 style="margin-top:15rem;">
                    <strong>พันธมิตรที่ร่วมรายการ</strong>
                </h2>
            </div>
        </center><br>
        <div class="row alliance">
            <div class="col-md-3">
                <div class="card alliance-food">
                    <div class="card-body text-center centered-element">
                        <h3 class="text-center">Food And Drink</h3><br>
                        <a href="">สิทธิพิเศษ</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card alliance-lifestyle">
                    <div class="card-body text-center centered-element">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Life Style</h3><br>
                                <a href="">สิทธิพิเศษ</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card alliance-travel">
                    <div class="card-body text-center centered-element">
                        <h3>Travel</h3><br>
                        <a href="">สิทธิพิเศษ</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card alliance-car">
                    <div class="card-body text-center centered-element">
                        <h3>Car Service</h3><br>
                        <a href="">สิทธิพิเศษ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
