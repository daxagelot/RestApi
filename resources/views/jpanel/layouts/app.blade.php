<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Font Awesome -->
    <link rel="icon" type="image/x-icon" href="{{asset('frontend/assets/images/icon.png')}}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    {{-- CK Editor --}}
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Stepper -->
    <link rel="stylesheet" href="{{asset('plugins/bs-stepper/css/bs-stepper.min.css')}}">
    {{-- jquery --}}
    <script  src="https://code.jquery.com/jquery-1.12.1.js"   integrity="sha256-VuhDpmsr9xiKwvTIHfYWCIQ84US9WqZsLfR4P7qF6O8="   crossorigin="anonymous"></script>
     
    @yield('styles')

    <!-- Custom styles for ourApp-->
    <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light bg-side">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                 <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                @php
                    $company=App\Models\Company::first();
                @endphp
                <li class="nav-item dropdown user-menu">
                    @if($company != null)
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('/storage/images/companyProfile/th/'.$company->company_logo) }}" class="user-image img-circle elevation-2"
                                alt="User Image">
                            <span class="d-none d-md-inline">{{$company->company_name}}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- User image -->
                            <li class="user-header bg-pcb">
                                <img src="{{ asset('/storage/images/companyProfile/th/'.$company->company_logo) }}" class="img-circle elevation-2" alt="UserImage">
                                <p>
                                    {{$company->company_name}}
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <a href="{{ route('company') }}" class="btn btn-default btn-flat">Company</a>
                            </li>
                        </ul>
                    @else
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('/dist/img/company.png') }}" class="user-image img-circle elevation-2"
                                alt="User Image">
                            <span class="d-none d-md-inline">Company Name</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- User image -->
                            <li class="user-header bg-pcb">
                                <img src="{{ asset('/dist/img/company.png') }}" class="img-circle elevation-2" alt="UserImage">
                                <p>
                                    Company Name
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <a href="{{ route('company') }}" class="btn btn-default btn-flat">Company</a>
                            </li>
                        </ul>
                    @endif
                </li>
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('/storage/images/userProfile/th/'.Auth::getUser()->avatar) }}" class="user-image img-circle elevation-2"
                            alt="User Image">
                        <span class="d-none d-md-inline">{{ Auth::getUser()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-pcb">
                            <img src="{{ asset('/storage/images/userProfile/th/'.Auth::getUser()->avatar) }}" class="img-circle elevation-2" alt="UserImage">
                            <p>
                            {{ Auth::getUser()->name }}
                                <small>{{ Auth::getUser()->role }}</small>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="{{ route('profile') }}" class="btn btn-default btn-flat">Profile</a>
                            <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right">Sign out</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    @if(hasAnyOnePermission('modules')||hasAnyOnePermission('users')||hasAnyOnePermission('roles')||hasAnyOnePermission('language'))
                    <a href="{{ route('admin.settings') }}" class="btn btn-link text-light" data-toggle="tooltip" title="AdminSttings"><i class="fas fa-cogs"></i></a>
                    @endif
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary bg-main elevation-4 ">
            <!-- Brand Logo -->
            <a href="{{route('dashboard')}}" class="brand-link">
                <img src="{{ asset('dist/img/logo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-dark text-dark">{{env('app_name')}}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- SidebarSearch Form -->
                <div class="form-inline mt-3 pb-3 mb-3">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar bg-white" style="border:none;" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar bg-side" style="border:none;">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class  with font-awesome or any other icon font library -->
                        @if(hasAnyOnePermission('dashboard'))
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ (request()->is('jpanel/dashboard')) ? 'menu-active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        @endif
                        @if(hasAnyOnePermission('country') || hasAnyOnePermission('state')|| hasAnyOnePermission('city'))
                        <li class="nav-item {{ (request()->is('jpanel/location*')) ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ (request()->is('jpanel/location*')) ? 'menu-active' : '' }}">
                                <i class="fas fa-globe-americas nav-icon"></i>
                                <p>
                                    Location
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if(hasAnyOnePermission('country'))
                                    <li class="nav-item">
                                        <a href="{{ route('list.country') }}" class="nav-link {{ (request()->is('jpanel/location/country')) ? 'menu-active' : '' }}">
                                            <i class="fas fa-flag-usa nav-icon"></i>
                                            <p>Country List</p>
                                        </a>
                                    </li>
                                @endif
                                @if(hasAnyOnePermission('state'))
                                    <li class="nav-item">
                                        <a href="{{ route('list.state') }}" class="nav-link {{ (request()->is('jpanel/location/state')) ? 'menu-active' : '' }}">
                                            <i class="fas fa-map-marked-alt nav-icon"></i>
                                            <p>State List</p>
                                        </a>
                                    </li>
                                @endif
                                @if(hasAnyOnePermission('city'))
                                    <li class="nav-item">
                                        <a href="{{ route('list.city') }}" class="nav-link {{ (request()->is('jpanel/location/city')) ? 'menu-active' : '' }}">
                                            <i class="fas fa-city nav-icon"></i>
                                            <p>City List</p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        @if(hasAnyOnePermission('category') || hasAnyOnePermission('attribute'))
                        <li class="nav-item {{ (request()->is('jpanel/catalog*')) ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ (request()->is('jpanel/catalog*')) ? 'menu-active' : '' }}">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>
                                    Catalog
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                @if(hasAnyOnePermission('category'))
                                <li class="nav-item">
                                    <a href="{{ route('list.category') }}" class="nav-link {{ (request()->is('jpanel/catalog/category')) ? 'menu-active' : '' }}">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <p>Category List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('create.category') }}" class="nav-link {{ (request()->is('jpanel/catalog/category/add')) ? 'menu-active' : '' }}">
                                        <i class="far fa-plus-square nav-icon"></i>
                                        <p>Category Add</p>
                                    </a>
                                </li>
                                @endif
                                {{-- @if(hasAnyOnePermission('gallery')) --}}
                                <li class="nav-item">
                                    <a href="{{ route('list.gallery') }}" class="nav-link {{ (request()->is('jpanel/catalog/gallery')) ? 'menu-active' : '' }}">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <p>Gallery List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('create.gallery') }}" class="nav-link {{ (request()->is('jpanel/catalog/gallery/add')) ? 'menu-active' : '' }}">
                                        <i class="far fa-plus-square nav-icon"></i>
                                        <p>Gallery Add</p>
                                    </a>
                                </li>
                                {{-- @endif --}}
                               
                                @if(hasAnyOnePermission('attribute'))
                                <li class="nav-item">
                                    <a href="{{ route('list.attributes') }}" class="nav-link {{ (request()->is('jpanel/catalog/attribute')) ? 'menu-active' : '' }}">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <p>Attribute List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('create.attribute') }}" class="nav-link {{ (request()->is('jpanel/catalog/attribute/add')) ? 'menu-active' : '' }}">
                                        <i class="far fa-plus-square nav-icon"></i>
                                        <p>Attribute Add</p>
                                    </a>
                                </li>
                                @endif
                               
                            </ul>
                        </li>
                        @endif
                        @if(hasAnyOnePermission('product'))
                        <li class="nav-item {{ (request()->is('jpanel/product*')) ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ (request()->is('jpanel/product*')) ? 'menu-active' : '' }}">
                                <i class="nav-icon fas fa-box"></i>
                                <p>
                                    Product
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                @if(hasAnyOnePermission('product'))
                                <li class="nav-item">
                                    <a href="{{ route('list.product') }}" class="nav-link {{ (request()->is('jpanel/product/list')) ? 'menu-active' : '' }}">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <p>Product List</p>
                                    </a>
                                </li>
                                @endif
                                @if(hasAnyOnePermission('product'))
                                <li class="nav-item">
                                    <a href="{{ route('add.product') }}" class="nav-link {{ (request()->is('jpanel/product/add')) ? 'menu-active' : '' }}">
                                        <i class="far fa-plus-square nav-icon"></i>
                                        <p>Add Product</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('team.index') }}" class="nav-link">
                                <i class="nav-icon fab fa-sellsy"></i>
                                <p>
                                    Team
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('chat.index') }}" class="nav-link">
                                <i class="nav-icon fab fa-sellsy"></i>
                                <p>
                                    Chat
                                </p>
                            </a>
                        </li>

                        @if(hasAnyOnePermission('bestselling'))
                        <li class="nav-item">
                            <a href="{{ route('list.bestSelling') }}" class="nav-link {{ (request()->is('jpanel/bestSelling')) ? 'menu-active' : '' }}">
                                <i class="nav-icon fab fa-sellsy"></i>
                                <p>
                                    Bestselling
                                </p>
                            </a>
                        </li>
                        @endif
                        @if(hasAnyOnePermission('review'))
                        <li class="nav-item">
                            <a href="{{ route('list.review') }}" class="nav-link {{ (request()->is('jpanel/review')) ? 'menu-active' : '' }}">
                                <i class="fas fa-comments nav-icon"></i>
                                <p>
                                    Review
                                </p>
                            </a>
                        </li>
                        @endif
                        @if(hasAnyOnePermission('contact'))
                        <li class="nav-item">
                            <a href="{{ route('list.contact') }}" class="nav-link {{ (request()->is('jpanel/contact')) ? 'menu-active' : '' }}">
                                <i class="fas fa-question-circle nav-icon"></i>
                                <p>
                                    Contact Inquiry
                                </p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
            <!-- /.sidebar-custom -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

                @yield('content')

        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block text-danger">
                <strong><span id='ct6' ></span></strong>
            </div>
            <strong>Copyright &copy; {{ now()->year }} <a href="https://pcubesoftechs.com">PCUBE SOFTECHS</a></strong> All rights
            reserved.
        </footer>


    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
   <!-- Stepper -->
    <script src="{{asset('plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Sweet Alert js -->
    <script src="{{ asset('dist/js/sweetalert.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <!-- Canvas  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.7.19/fabric.min.js"></script>
    <!-- Custom Scripts -->
    <script src="{{ asset('dist/js/customscript.js') }}"></script>
    {{-- ck editor --}}
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    @yield('scripts')
</body>
</html>
