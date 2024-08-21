<div class="min-height-300 bg-primary position-absolute w-100"></div>
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="{{url('/partner/dashboard')}}">
      <span class="ms-1 font-weight-bold">TOUCHJAI DASHBOARD</span>
      @php
          $name = Auth::guard('partner')->user()->name;
          $branch = Auth::guard('partner')->user()->branch;
      @endphp
      <p>{{$name}} สาขา{{$branch}}</p>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link " href="{{url('partner/report-partner')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-file-pdf-o text-dark text-sm opacity-10 mb-2"></i>
          </div>
          <span class="nav-link-text ms-1">รายงานข้อมูลการใช้งาน</span>
        </a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link " href="{{url('partner/coupon')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-ticket text-dark text-sm opacity-10 mb-2"></i>
          </div>
          <span class="nav-link-text ms-1">คูปอง</span>
        </a>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link" href="{{ route('partner.logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-button-power text-dark text-sm opacity-10 mb-2"></i>
          </div>
          <span class="nav-link-text ms-1">ออกจากระบบ</span>
        </a>
        <form id="logout-form" action="{{ 'App\PartnerShop' == Auth::getProvider()->getModel() ? route('partner.logout') : route('partner.logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
    </ul>
  </div>
</aside>