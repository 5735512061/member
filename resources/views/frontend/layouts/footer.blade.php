	<!-- footer -->
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-6">
					<div class="footer-box">
						<h2 class="widget-title" style="color: #f0b6b5; font-weight:bold;">TOUCHJAI</h2>
						<ul>
							<li><a href="{{url('about-us')}}">เกี่ยวกับเรา</a></li>
							<li><a href="{{url('allarticle')}}">บทความและข่าวสาร</a></li>
							<li><a href="{{url('condition')}}">ข้อกำหนดและเงื่อนไข</a></li>
							<li><a href="{{url('help-center')}}">ศูนย์ช่วยเหลือ</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-6">
					<div class="footer-box">
						<h2 class="widget-title">สมาชิก</h2>
						<ul>
							{{-- <li><a href="{{url('rewards')}}">REWARD</a></li> --}}
							<li><a href="{{url('alliance')}}">สิทธิพิเศษ</a></li>
							<li><a href="https://ctp.is/8/9138713" target="_blank">E-COUPON</a></li>
							<li><a href="https://lin.ee/dglPjnl" target="_blank">สมัครสมาชิก</a></li>
							{{-- @if(Auth::guard('member')->user() == NULL)
								<li><a href="{{url('member/login')}}">เข้าสู่ระบบ</a></li>
							@endif

							@auth('member')
								<li>
									<a href="{{url('member/profile')}}">บัญชีสมาชิก</a>
								</li>
							@endauth --}}
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-6">
					<div class="footer-box">
						<h2 class="widget-title about-us">ติดตามเรา</h2>
						<ul>
							<li><a href="https://www.facebook.com/touchjaiprivilege" target="_blank">Facebook</a></li>
							<li><a href="https://lin.ee/dglPjnl" target="_blank">Line Official Account</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-6">
					<div class="footer-box">
						<h2 class="widget-title">ศูนย์บริการสมาชิก</h2>
						<p>082-628-2244</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end footer -->