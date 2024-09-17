<!-- Start::main-sidebar-header -->
<div class="main-sidebar-header">
    <a href="index.html" class="header-logo">
        <img src="{{ asset('dashboard/assets/images/brand-logos/desktop-white.png')}}" class="desktop-white" alt="logo">
        <img src="{{ asset('dashboard/assets/images/brand-logos/toggle-white.png')}}" class="toggle-white" alt="logo">
        <img src="{{ asset('dashboard/assets/images/brand-logos/desktop-logo.png')}}" class="desktop-logo" alt="logo">
        <img src="{{ asset('dashboard/assets/images/brand-logos/toggle-dark.png')}}" class="toggle-dark" alt="logo">
        <img src="{{ asset('dashboard/assets/images/brand-logos/toggle-logo.png')}}" class="toggle-logo" alt="logo">
        <img src="{{ asset('dashboard/assets/images/brand-logos/desktop-dark.png')}}" class="desktop-dark" alt="logo">
    </a>
</div>
<!-- End::main-sidebar-header -->
<!-- Start::main-sidebar -->
<div class="main-sidebar" id="sidebar-scroll">
    <!-- Start::nav -->
    <nav class="main-menu-container nav nav-pills flex-column sub-open">
        <div class="slide-left" id="slide-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
            </svg>
        </div>
        <ul class="main-menu">
            <!-- Start::slide__category -->
            <li class="slide__category"><span class="category-name">{{ __('Dashboard') }}</span></li>
            <!-- End::slide__category -->

            <!-- Start::slide -->
            <li class="slide {{ request()->segment(2) == 'admin' ? 'active' : '' }}">
                <a href="" class="side-menu__item">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class="ti-home side-menu__icon"></i>
                    <span class="side-menu__label">{{ __('Dashboard') }}</span>
                </a>
            </li>
            <!-- End::slide -->

            <!-- Start::slide -->
            <li class="slide has-sub {{ request()->segment(2) == 'permissions' ? 'active' : '' }}">
                <a href="javascript:void(0);" class="side-menu__item">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class="ti-wallet side-menu__icon"></i>
                    <span class="side-menu__label">{{ __('Administration') }}</span>
                    <i class="fe fe-chevron-right side-menu__angle"></i>
                </a>
                <ul class="slide-menu child1">
                    <li class="slide side-menu__label1">
                        <a href="javascript:void(0)">Crypto Currencies</a>
                    </li>
                    {{-- @can('permissions')  --}}

                    <li class="slide {{ request()->segment(2) == 'permissions' ? 'active' : '' }}">
                        <a href="{{ route('permissions.index') }}" class="side-menu__item">{{ __('Permissions') }}</a>
                    </li>

                    {{-- @can('roles')  --}}
                    <li class="slide">
                        <a href="{{ route('roles.index') }}" class="side-menu__item">{{ __('Roles') }}</a>
                    </li>
                    {{-- @endcan  --}}

                    {{-- @can('admins')  --}}
                    <li class="slide">
                        <a href="{{ route('users.index') }}" class="side-menu__item">{{ __('Users') }}</a>
                    </li>
                    {{-- @endcan  --}}

                   
        </ul>
        </li>
        <!-- End::slide -->




        <!-- End::slide -->
        </ul>
        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
            </svg></div>
    </nav>
    <!-- End::nav -->

</div>
<!-- End::main-sidebar -->
