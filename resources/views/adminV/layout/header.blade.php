<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
       <a class="navbar-brand brand-logo mr-5" href="{{url('/')}}"><img src="{{asset('costumer/images/logo-top-1.png')}}" class="mr-2" alt="logo"/></a>
       <a class="navbar-brand brand-logo-mini" href="{{url('/')}}"><img src="{{asset('adminP/images/logo-top-mini.png')}}" alt="logo"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
       <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
       <span class="icon-menu"></span>
       </button>
       <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a href='{{url('admin/logout')}}' class="dropdown-item">
               <i class="ti-power-off text-primary"></i>
               Logout
               </a>
          </li>
       </ul>
       <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
       <span class="icon-menu"></span>
       </button>
    </div>
 </nav>