<!-- header -->
<div class="top-header-area" id="sticker">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-sm-12 text-center">
				<div class="main-menu-wrap">
					<!-- logo -->
					<div class="site-logo">
						<a href="{{url('/')}}">
							<img src="{{ asset('frontend/assets/img/logo.png')}}" alt="touchjai-logo" width="50%" style="margin-top: -1rem;">
						</a>
					</div>
					<!-- logo -->
					<!-- menu start -->
					<nav class="main-menu">
						<ul>
							<li><a href="{{url('/')}}">หน้าหลัก</a></li>
							<li><a href="{{url('about-us')}}" class="gradient-text">TOUCHJAI</a></li>
							{{-- <li><a href="{{url('rewards')}}">REWARD</a></li> --}}
							<li><a href="{{url('alliance')}}">สิทธิพิเศษ</a></li>
							<li><a href="{{url('allarticle')}}">บทความและข่าวสาร</a></li>
							<li><a href="https://ctp.is/8/9138713" target="_blank">E-COUPON</a></li>
							<li><a href="https://ctp.is/8/9138713" target="_blank">เข้าสู่ระบบสมาชิก</a></li>
							{{-- @if(Auth::guard('member')->user() == NULL)
								<li><a href="{{url('member/login')}}">เข้าสู่ระบบ</a></li>
							@endif

							@auth('member')
								<li>
									<a href="{{url('member/profile')}}">บัญชีสมาชิก</a>
								</li>
							@endauth --}}
						</ul>
					</nav>
					<div class="mobile-menu"></div>
					<!-- menu end -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end header -->