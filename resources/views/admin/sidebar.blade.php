  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/')}}" target="_blank" class="brand-link">
      <img src="{{ asset('admin_assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{Config::get('myconstants.site_short_name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('admin_assets/dist/img/my-prof-min.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Welcome Admin</a><a href="{{ route('logout')}}" class="btn btn-block btn-success btn-sm">LOGOUT</a>
        </div>
      </div>

    
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
		   <li class="nav-item">
            <a href="{{ route('dash') }}" class="nav-link @yield('select_dash')">
             <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('categories.index') }}" class="nav-link @yield('select_cat')">
             <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Categories
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('subcategories.index') }}" class="nav-link @yield('select_subcat')">
             <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Sub Categories
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('colors.index') }}" class="nav-link @yield('select_color')">
             <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Colors
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('sizes.index') }}" class="nav-link @yield('select_size')">
             <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Sizes
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('taxes.index') }}" class="nav-link @yield('select_tax')">
             <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Taxes
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('products.index') }}" class="nav-link @yield('select_product')">
             <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Products
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('brands.index') }}" class="nav-link @yield('select_brand')">
             <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Brands
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('coupons.index') }}" class="nav-link @yield('select_coupon')">
             <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Coupons
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <style>
    body:not(.layout-fixed) .main-sidebar .sidebar {
    overflow-y: unset;
}
    </style>