<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{asset('assets')}}"
  data-template="vertical-menu-template"
>
  <head>
    <meta charset="utf-8" />
    @yield('meta_header')
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    @can('read.only.superadmin')
        <title>Dashboard | Administrator</title>
    @endcan
    @can('read.only.mahasiswa')
        <title>Dashboard | Mahasiswa</title>
    @endcan

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('background/logo-jsh.png')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons -->
    <link rel="stylesheet" href="{{url('assets/vendor/fonts/fontawesome.css')}}" />
    <link rel="stylesheet" href="{{url('assets/vendor/fonts/tabler-icons.css')}}" />
    <link rel="stylesheet" href="{{url('assets/vendor/fonts/flag-icons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{url('assets/vendor/css/rtl/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{url('assets/vendor/css/rtl/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{url('assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
  <link rel="stylesheet" href="{{url('assets/vendor/libs/node-waves/node-waves.css')}}" />
  <link rel="stylesheet" href="{{url('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
  <link rel="stylesheet" href="{{url('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
  <link rel="stylesheet" href="{{url('assets/vendor/libs/swiper/swiper.css')}}" />
  <link rel="stylesheet" href="{{url('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
  <link rel="stylesheet" href="{{url('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
  <link rel="stylesheet" href="{{url('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />
  <link rel="stylesheet" href="{{url('assets/vendor/libs/select2/select2.css')}}" />
  <link rel="stylesheet" href="{{url('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
  <link rel="stylesheet" href="{{url('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css')}}" />
  <link rel="stylesheet" href="{{url('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css')}}" />
  <link rel="stylesheet" href="{{url('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
  <link rel="stylesheet" href="{{url('assets/vendor/libs/bs-stepper/bs-stepper.css')}}" />
  <link rel="stylesheet" href="{{url('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
  <link rel="stylesheet" href="{{url('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
  <link rel="stylesheet" href="{{url('assets/vendor/libs/jquery-timepicker/jquery-timepicker.css')}}" />
  <link rel="stylesheet" href="{{url('assets/vendor/libs/pickr/pickr-themes.css')}}" />
  <link rel="stylesheet" href="{{url('assets/vendor/libs/tagify/tagify.css')}}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{url('assets/vendor/css/pages/cards-advance.css')}}" />
    <!-- Helpers -->
    <script src="{{url('assets/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{url('assets/vendor/js/template-customizer.js')}}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{url('assets/js/config.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('page_style')
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="" class="app-brand-link">
              <span class="demo mt-3">
                <img src={{ asset('background/logo-jsh.png') }} alt="icon" style="margin-bottom: 10px;" width="auto" height="50px">
              </span>
              <span class="app-brand-text demo menu-text fw-bold">Magang</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
              <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            @can('read.only.mahasiswa')
            <!-- Apps & Pages -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Mahasiswa</span>
            </li>
            <li class="menu-item {{ request()->is('mahasiswa*') ? 'inactive' : ''}}">
              <a href="/mahasiswa" class="menu-link">
                <i class="menu-icon ti ti-smart-home    "></i>
                <div data-i18n="Dashboard">Dashboard</div>
              </a>
            </li>
            <li class="menu-item {{ request()->is('mahasiswa/loogbook*') ? 'active' : ''}}">
              <a href="/mahasiswa/loogbook"  class="menu-link">
                <i class="menu-icon tf-icons ti ti-file"></i>
                <div data-i18n="Logbook">Logbook</div>
              </a>
            </li>
            <li class="menu-item {{ request()->is('mahasiswa/presensi*') ? 'active' : ''}}">
              <a href="/mahasiswa/presensi" class="menu-link">
                <i class="menu-icon tf-icons ti ti-clock"></i>
                <div data-i18n="Presensi">Presensi</div>
              </a>
            </li>
            <li class="menu-item {{ request()->is('mahasiswa/profile*') ? 'active open' : ''}}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-users"></i>
                    <div data-i18n="Profile Mahasiswa">Profile Mahasiswa</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('mahasiswa/profile*') ? 'active' : ''}}">
                        <a href="{{url('mahasiswa/profile', Auth::user()->nim)}}"  class="menu-link">
                        <div data-i18n="Profile Settings">Profile Settings</div>
                        </a>
                    </li>
                    </ul>
                    <ul class="menu-sub">

                    {{-- <li class="menu-item">
                        <a href="#" class="menu-link">
                        <div data-i18n="Security">Security</div>
                        </a>
                    </li> --}}
                </ul>
            </li>
            @endcan
            @can('read.only.superadmin')
            <!-- Apps & Pages -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Administrator JSH</span>
            </li>
            <li class="menu-item">
              <a href="/super-admin" class="menu-link">
                <i class="menu-icon ti ti-smart-home    "></i>
                <div data-i18n="Dashboard">Dashboard</div>
              </a>
            </li>
            <li class="menu-item {{ request()->is('super-admin/presensi*') ? 'active' : ''}}">
              <a href="/super-admin/presensi" class="menu-link">
                <i class="menu-icon tf-icons ti ti-file"></i>
                <div data-i18n="Presensi Mahasiswa">Presensi Mahasiswa</div>
              </a>
            </li>
            <li class="menu-item {{ request()->is('super-admin/logbook*') ? 'active' : ''}}">
              <a href="/super-admin/logbook" class="menu-link">
                <i class="menu-icon tf-icons ti ti-book"></i>
                <div data-i18n="Logbook Mahasiswa">Logbook Mahasiswa</div>
              </a>
            </li>
            <li class="menu-item {{ request()->is('super-admin/master*') ? 'active open' : ''}}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-database"></i>
                    <div data-i18n="Master Data">Master Data</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('super-admin/master-universitas*') ? 'active' : ''}}">
                        <a href="/super-admin/master-universitas" class="menu-link">
                        <div data-i18n="Universitas/SMA/SMK">Universitas/SMA/SMK</div>
                        </a>
                    </li>
                </ul>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('super-admin/master-jurusan*') ? 'active' : ''}}">
                        <a href="/super-admin/master-jurusan" class="menu-link">
                        <div data-i18n="Jurusan">Jurusan</div>
                        </a>
                    </li>
                </ul>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('super-admin/master-mahasiswa*') ? 'active' : ''}}">
                        <a href="/super-admin/master-mahasiswa" class="menu-link">
                        <div data-i18n="Mahasiswa">Mahasiswa</div>
                        </a>
                    </li>
                </ul>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('super-admin/master-masa-magang*') ? 'active' : ''}}">
                        <a href="/super-admin/master-masa-magang" class="menu-link">
                        <div data-i18n="Masa Magang">Masa Magang</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item {{ request()->is('super-admin/data-pegawai*') ? 'active' : ''}}">
              <a href="/super-admin/data-pegawai" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Data Pegawai">Data Pegawai</div>
              </a>
            </li>
            @endcan
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="ti ti-menu-2 ti-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

              <ul class="navbar-nav flex-row align-items-center ms-auto">

                @php
                $user = Auth::user();
                @endphp
                <span class="badge bg-label-success mt-1">{{ $user->getRoleNames()->implode(', ') }}</span>
                <!-- Style Switcher -->
                <li class="nav-item me-2 me-xl-0">
                  <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                    <i class="ti ti-md"></i>
                  </a>
                </li>
                <!--/ Style Switcher -->
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../../assets/img/avatars/1.png" alt class="h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../../assets/img/avatars/1.png" alt class="h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{ ucwords($user->name) }}</span>
                            <small class="text-muted">{{ ucwords($user->email) }}</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{url('mahasiswa/profile', Auth::user()->nim)}}">
                        <i class="ti ti-user-check me-2 ti-sm"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="ti ti-settings me-2 ti-sm"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal" href="{{ route('logout') }}">
                        <i class="ti ti-logout me-2 ti-sm"></i>
                        <span class="align-middle">Logout</span>
                    </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
            <!-- Search Small Screens -->
            <div class="navbar-search-wrapper search-input-wrapper d-none">
              <input
              type="text"
              class="form-control search-input container-xxl border-0"
              placeholder="Search..."
              aria-label="Search..."
              />
              <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
            </div>
          </nav>
         <!-- Content wrapper -->
         <div class="content-wrapper">
          <!-- Content -->
          <!-- Modal logout-->
          <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                      </div>
                      <div class="modal-body text-center" style="display:block;">
                          Apakah Anda Ingin Keluar Dari Akun Ini?
                      </div>
                      <div class="modal-footer" style="display: flex; justify-content:center;">
                          <a href="{{ route('logout') }}"><button type="button" class="btn btn-success" data-dismiss="modal">Iya</button></a>
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                      </div>
                  </div>
              </div>
          </div>

          <div class="container-xxl flex-grow-1 container-p-y">

