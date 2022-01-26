<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('images/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8; border-radius: 50%">
        <span class="brand-text font-weight-light">Amar Store</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url('images/adminPhoto/'.Auth::guard('admin')->user()->image) }}"
                     class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ ucwords(Auth::guard('admin')->user()->name) }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @if(Session::get('page') == 'dashboard')
                    <?php $active = "active"; ?>
                @else
                    <?php $active = ""; ?>
                @endif
                <li class="nav-item">
                    <a href=" {{url('/admin/dashboard')}} " class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <!-- Catalogues -->
                @if(Session::get('page') == 'sections' ||
                    Session::get('page') == 'brands' ||
                    Session::get('page') == 'categories' ||
                    Session::get('page') == 'products' ||
                    Session::get('page') == 'coupons' ||
                    Session::get('page') == 'banners' ||
                    Session::get('page') == 'orders' ||
                    Session::get('page') == 'reviews' ||
                    Session::get('page') == 'shipping')
                    <?php $active = "active"; $menuOpen = "menu-open";?>
                @else
                    <?php $active = ""; $menuOpen = "";?>
                @endif
                <li class="nav-item has-treeview {{ $menuOpen }}">
                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Catalogues
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- sections -->
                        @if(Session::get('page') == "sections")
                            <?php $active = "active"; ?>
                        @else
                            <?php $active = ""; ?>
                        @endif
                        <li class="nav-item active">
                            <a href="{{ url('/admin/sections') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sections</p>
                            </a>
                        </li>

                        <!-- brands -->
                        @if(Session::get('page') == "brands")
                            <?php $active = "active"; ?>
                        @else
                            <?php $active = ""; ?>
                        @endif
                        <li class="nav-item active">
                            <a href="{{ url('/admin/brands') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Brands</p>
                            </a>
                        </li>

                        <!-- categories -->
                        @if(Session::get('page') == "categories")
                            <?php $active = "active"; ?>
                        @else
                            <?php $active = ""; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('/admin/categories') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>

                        <!-- products -->
                        @if(Session::get('page') == "products")
                            <?php $active = "active"; ?>
                        @else
                            <?php $active = ""; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('/admin/products') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Products</p>
                            </a>
                        </li>

                        <!-- banners -->
                        @if(Session::get('page') == "banners")
                            <?php $active = "active"; ?>
                        @else
                            <?php $active = ""; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('/admin/banners') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Banners</p>
                            </a>
                        </li>

                        <!-- coupons -->
                        @if(Session::get('page') == "coupons")
                            <?php $active = "active"; ?>
                        @else
                            <?php $active = ""; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('/admin/coupons') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Coupons</p>
                            </a>
                        </li>

                        <!-- orders -->
                        @if(Session::get('page') == "orders")
                            <?php $active = "active"; ?>
                        @else
                            <?php $active = ""; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('/admin/orders') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Orders</p>
                            </a>
                        </li>

                        <!-- shipping charges -->
                        @if(Session::get('page') == "shipping")
                            <?php $active = "active"; ?>
                        @else
                            <?php $active = ""; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('/admin/view-shipping-charges') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Shipping Charges</p>
                            </a>
                        </li>

                        <!-- reviews -->
                        @if(Session::get('page') == "reviews")
                            <?php $active = "active"; ?>
                        @else
                            <?php $active = ""; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('/admin/reviews') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reviews</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @if(Session::get('page') == 'settings' || Session::get('page') == 'updateCurrentPass' || Session::get('page') == 'updateAdminDetails')
                    <?php $active = "active"; $menuOpen = "menu-open";?>
                @else
                    <?php $active = ""; $menuOpen = "";?>
                @endif
                <li class="nav-item has-treeview {{ $menuOpen }}">
                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Settings
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(Session::get('page')=="updateAdminDetails")
                            <?php $active = "active"; ?>
                        @else
                            <?php $active = ""; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('/admin/updateAdminDetails')  }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Update Profile</p>
                            </a>
                        </li>

                        @if(Session::get('page') == "settings")
                            <?php $active = "active"; ?>
                        @else
                            <?php $active = ""; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('/admin/settings')  }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
