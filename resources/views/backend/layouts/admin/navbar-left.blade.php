<div class="min-height-300 bg-primary position-absolute w-100"></div>
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="{{url('/dashboard')}}">
      {{-- <img src="{{ asset('assets/img/logo-ct-dark.png')}}" class="navbar-brand-img h-100" alt="main_logo"> --}}
      <span class="ms-1 font-weight-bold text-copper" style="text-align: center; font-size:1.5rem;">THE SECRET</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{url('/dashboard')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-pie-chart text-copper text-sm opacity-10 mb-2"></i>
          </div>
          <span class="nav-link-text ms-1">ภาพรวม (Dashboard)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/addpoint')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-plus-circle text-sm opacity-10 mb-2 text-dark"></i>
          </div>
          <span class="nav-link-text ms-1">เพิ่มพอยท์</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/member/list')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-users text-copper text-sm opacity-10 mb-2"></i>
          </div>
          <span class="nav-link-text ms-1">สมาชิก</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/campaign')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-ticket text-dark text-sm opacity-10 mb-2"></i>
          </div>
          <span class="nav-link-text ms-1">แคมเปญ</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/reward')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-gift text-copper text-sm opacity-10 mb-2"></i>
          </div>
          <span class="nav-link-text ms-1">ของรางวัล</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/account-store')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-university text-dark text-sm opacity-10 mb-2"></i>
          </div>
          <span class="nav-link-text ms-1">บัญชีร้านค้า</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/partner')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-handshake-o text-copper text-sm opacity-10 mb-2"></i>
          </div>
          <span class="nav-link-text ms-1">เครือข่ายพันธมิตร</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/report-partner')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-file-pdf-o text-dark text-sm opacity-10 mb-2"></i>
          </div>
          <span class="nav-link-text ms-1">รายงานข้อมูลร้านค้าพันธมิตร</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/article')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-newspaper-o text-copper text-sm opacity-10 mb-2"></i>
          </div>
          <span class="nav-link-text ms-1">บทความและข่าวสาร</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/media')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-image text-dark text-sm opacity-10 mb-2"></i>
          </div>
          <span class="nav-link-text ms-1">Media</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-button-power text-copper text-sm opacity-10 mb-1"></i>
          </div>
          <span class="nav-link-text ms-1">ออกจากระบบ</span>
        </a>
        <form id="logout-form" action="{{ 'App\Admin' == Auth::getProvider()->getModel() ? route('admin.logout') : route('admin.logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
    </ul>
  </div>
</aside>