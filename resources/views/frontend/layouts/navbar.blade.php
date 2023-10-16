<!-- header -->
<div class="top-header-area" id="sticker">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-sm-12 text-center">
				<div class="main-menu-wrap">
					<!-- logo -->
					<div class="site-logo">
						<a href="{{url('/')}}">
							<img src="{{ asset('frontend/assets/img/logo.png')}}" alt="">
						</a>
					</div>
					<!-- logo -->
					<!-- menu start -->
					<nav class="main-menu">
						<ul>
							<li><a href="{{url('/')}}">หน้าหลัก</a></li>
							<li><a href="{{url('about-us')}}" style="color: #e57d0d; font-weight:bold;">อิสระ</a></li>
							<li><a href="{{url('rewards')}}">ของรางวัล</a></li>
							<li><a href="{{url('alliance')}}">พันธมิตรในเครือ</a></li>
							<li><a href="{{url('allarticle')}}">บทความและข่าวสาร</a></li>
							{{-- <li><a href="{{url('privilege')}}">สิทธิประโยชน์</a></li> --}}
							@if(Auth::guard('member')->user() == NULL)
								<li><a href="{{url('member/login')}}">เข้าสู่ระบบ</a></li>
							@endif

							@auth('member')
								<li>
									<a href="{{url('member/profile')}}">บัญชีสมาชิก</a>
								</li>
							@endauth
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