<!doctype html>
<html lang="en">

<head>
    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="Templist - HTML5 Premium Digital goods marketplace directory jquery css responsive website Template" name="description">
    <meta content="Spruko Technologies Private Limited" name="author">
    <meta name="keywords" content="dashboard template, bootstrap admin template, bootstrap admin template, admin template, bootstrap dashboard, html template, css templates, bootstrap form template, bootstrap 4 templates, bootstrap dashboard template, admin dashboard template, html dashboard template, bootstrap grid template, html admin template, bootstrap 4 admin template, bootstrap 4 dashboard, bootstrap admin, admin dashboard, html and css templates, themeforest html, themeforest html templates, template html5 bootstrap" />

    <!-- Favicon -->
    <link rel="icon" href="{{asset('favicon.png')}}" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.png')}}" />

    <!-- Title -->
    <title>Templist - HTML5 Premium Digital goods marketplace directory jquery css responsive website Template</title>

    <!-- Bootstrap css -->
    <link href="{{asset('assets/plugins/bootstrap-4.3.1/css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- Sidemenu Css -->
    <link href="{{asset('assets/css/sidemenu.css')}}" rel="stylesheet" />

    <!-- Dashboard Css -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/admin-custom.css')}}" rel="stylesheet" />

    <!-- c3.js')}} Charts Plugin -->
    <link href="{{asset('assets/plugins/charts-c3/c3-chart.css')}}" rel="stylesheet" />

    <!-- p-scroll bar css-->
    <link href="{{asset('assets/plugins/pscrollbar/pscrollbar.css')}}" rel="stylesheet" />

    <!---Font icons-->
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" />

    <!---P-scroll Bar css -->
    <link href="{{asset('assets/plugins/pscrollbar/pscrollbar.css')}}" rel="stylesheet" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />

    <!-- Color Skin css -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('assets/color-skins/color4.css')}}" />
    <style>
        #profileImage {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', cursive;
            font-weight: 500;
            border-radius: 50%;
            color: #fff;
            background: #3b62fe !important;
            text-align: center;
            width: 50px;
            height: 50px;
        }

        .toast-top-full-width {
            margin-top: 20px !important;
        }
    </style>

</head>


@if(\Illuminate\Support\Facades\App::environment() == 'production')
    <script id="https">
        if (location.href.indexOf('https:') !== 0) {
            location.href = location.href.replace('http:', 'https:');
            document.getElementById('https').remove();
        }
    </script>
@endif
<body class="app sidebar-mini">

    <!--Loader-->
    <div id="global-loader">
        <img src="{{asset('assets/images/loader.svg')}}" class="loader-img" alt="">
    </div>
    <!--Loader-->

    <!--Page-->
    <div class="page">
        <div class="page-main h-100">

            <!--App-Header-->
            <div class="app-header1 header py-1 d-flex">
                <div class="container-fluid">
                    <div class="d-flex">
                        <a class="header-brand" href="/">
                            <img src="{{asset('HajMaLabLogoWhite.png')}}" class="header-brand-img" alt="Lmslist logo">
                        </a>
                        <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>
                        <div class="header-navicon">
                            <a href="#" data-toggle="search" class="nav-link d-lg-none navsearch-icon">
                                <i class="fe fe-search"></i>
                            </a>
                        </div>
                        <div class="header-navsearch">
                            <form class="form-inline mr-auto">
                                <div class="nav-search">
                                    <input type="search" class="form-control header-search" placeholder="Search…" aria-label="Search">
                                    <button class="btn" type="submit"><i class="fe fe-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="d-flex order-lg-2 ml-auto">

                            <div class="dropdown d-none d-md-flex">
                                <a class="nav-link icon full-screen-link">
                                    <i class="fe fe-maximize-2" id="fullscreen-button"></i>
                                </a>
                            </div>

                            <div class="dropdown d-none d-md-flex">
                                <a class="nav-link icon" data-toggle="dropdown">
                                    <i class="fe fe-grid"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow  app-selector">
                                    <ul class="drop-icon-wrap">
                                        <li>
                                            <a href="#" class="drop-icon-item">
                                                <i class="icon icon-speech text-dark"></i>
                                                <span class="block"> E-mail</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="drop-icon-item">
                                                <i class="icon icon-map text-dark"></i>
                                                <span class="block">map</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="drop-icon-item">
                                                <i class="icon icon-bubbles text-dark"></i>
                                                <span class="block">Messages</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="drop-icon-item">
                                                <i class="icon icon-user-follow text-dark"></i>
                                                <span class="block">Followers</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="drop-icon-item">
                                                <i class="icon icon-picture text-dark"></i>
                                                <span class="block">Photos</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="drop-icon-item">
                                                <i class="icon icon-settings text-dark"></i>
                                                <span class="block">Settings</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item text-center">View all</a>
                                </div>
                            </div>
                            <div class="dropdown ">
                                <a href="#" class="nav-link pr-0 leading-none user-img" data-toggle="dropdown">
                                    @if(Auth::user()->profile_image != '')
                                    <img src="{{Auth::user()->profile_image}}" class="avatar avatar-md brround" alt="{{Auth::user()->username}}">
                                    @else
                                    <div class="profileImage avatar avatar-lg brround"></div>
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
                                    <a class="dropdown-item" href="{{route('password_change')}}">
                                        <i class="dropdown-icon  icon icon-settings"></i> Password Change
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="dropdown-icon icon icon-power"></i> Log out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/App-Header-->

            <!-- Sidebar menu-->
            <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
            <aside class="app-sidebar doc-sidebar">
                <div class="app-sidebar__user clearfix">
                    <div class="dropdown user-pro-body">
                        <div class="d-flex justify-content-center">
                            @if(Auth::user()->profile_image != '')
                            <img src="{{Auth::user()->profile_image}}" class="avatar avatar-lg brround" alt="{{Auth::user()->username}}">
                            @else
                            <div class="profileImage avatar avatar-lg brround"></div>
                            @endif
                            <a href=" {{route('edit_profile',Auth::user()->username)}} " class="profile-img">
                                <span class="fa fa-pencil" aria-hidden="true"></span>
                            </a>
                        </div>
                        <div class="user-info">
                            <h2 id="full_name">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h2>
                        </div>
                    </div>
                </div>
                <ul class="side-menu">
                    <li>
                        <a class="side-menu__item" href="{{route('home')}}"><i class="side-menu__icon fe fe-airplay"></i><span class="side-menu__label">Dashboard</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item" href="{{route('register_users')}}"><i class="side-menu__icon fe fe-users"></i><span class="side-menu__label">Users
                            </span>
                            <x-register-user />
                        </a>
                    </li>
                    <li>
                        <a class="side-menu__item" href="{{route('orders')}}"><i class="side-menu__icon fe fe-shopping-bag"></i><span class="side-menu__label">Orders
                            </span>
                            <x-order />
                        </a>
                    </li>
                    <li>


                        <a class="side-menu__item" href="{{route('bank_account')}}"><i class="side-menu__icon fa fa-dollar"></i><span class="side-menu__label">Bank Accounts
                            </span>
                        </a>
                    </li>
                    <li>
                        <a class="side-menu__item" href="{{route('user_reports')}}"><i class="side-menu__icon fe fe-user-x"></i><span class="side-menu__label">User Reports
                            </span>
                            <x-report-user />
                        </a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fe fe-folder"></i><span class="side-menu__label">Project
                                settings</span><i class="angle fa fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            <!-- <li><a class="slide-item" href="{{route('file_upload_test')}}">file_upload_test</a></li> -->
                            <li><a class="slide-item" href="{{route('projects')}}">Projects</a></li>
                            <li><a class="slide-item" href="{{route('project_upload')}}">Project Upload</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="side-menu__item" href="{{route('categories')}}"><i class="side-menu__icon fe fe-align-justify"></i><span class="side-menu__label">Categories</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item" href="{{route('browsers')}}"><i class="side-menu__icon fe fe-globe"></i><span class="side-menu__label">Browsers</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item" href="{{route('layouts')}}"><i class="side-menu__icon fe fe-layout"></i><span class="side-menu__label">Layout</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item" href="{{route('compatibles')}}"><i class="side-menu__icon fe fe-aperture"></i><span class="side-menu__label">Compatible</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item" href="{{route('videos')}}"><i class="side-menu__icon fe fe-video"></i><span class="side-menu__label">Video Plugins</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item" href="{{route('review_categories')}}"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">Review Categories</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item" href="{{route('header')}}"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">Header</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item" href="{{route('footer')}}"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">Footer</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item" href="{{route('socials')}}"><i class="side-menu__icon fe fe-activity"></i><span class="side-menu__label">Socials</span></a>
                    </li>
                    <li>
                        <a class="side-menu__item" href="{{route('apikeys')}}"><i class="side-menu__icon fe fe-activity"></i><span class="side-menu__label">Api Key</span></a>
                    </li>
                </ul>
            </aside>
            <div class="app-content">
                @yield('content')
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-lg-12 col-sm-12 text-center">
                        Copyright © 2020 HajMaLABS. Designed by <a href="https://www.hajma.info/terms-conditions/6?language=en" class="fs-14 text-primary"> HajMa Group of Company </a>All rights reserved.
                    </div>

                </div>
            </div>
        </footer>
        <!--/Footer-->

    </div>

    <!-- Back to top -->
    <a href="#top" id="back-to-top"><i class="fa fa-long-arrow-up"></i></a>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <!-- Bootstrap js -->
    <script src="{{asset('assets/plugins/bootstrap-4.3.1/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-4.3.1/js/bootstrap.min.js')}}"></script>

    <!--JQuery Sparkline Js-->
    <script src="{{asset('assets/js/jquery.sparkline.min.js')}}"></script>

    <!-- Circle Progress Js-->
    <script src="{{asset('assets/js/circle-progress.min.js')}}"></script>

    <!-- Star Rating Js-->
    <script src="{{asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>

    <!-- Fullside-menu Js-->
    <script src="{{asset('assets/plugins/sidemenu/sidemenu.js')}}"></script>


    <!-- p-scroll bar Js-->
    <script src="{{asset('assets/plugins/pscrollbar/pscrollbar.js')}}"></script>
    <script src="{{asset('assets/plugins/pscrollbar/pscroll.js')}}"></script>

    <!--Counters -->
    <script src="{{asset('assets/plugins/counters/counterup.min.js')}}"></script>
    <script src="{{asset('assets/plugins/counters/waypoints.min.js')}}"></script>

    <!-- CHARTJS CHART -->
    <script src="{{asset('assets/plugins/chart/chart.bundle.js')}}"></script>
    <script src="{{asset('assets/plugins/chart/utils.js')}}"></script>

    <!-- Index Scripts -->
    <script src="{{asset('assets/plugins/echarts/echarts.js')}}"></script>
    <script src="{{asset('assets/js/index4.js')}}"></script>


    <!-- Custom Js-->
    <script src="https://malsup.github.io/jquery.blockUI.js"> </script>

    <script src="{{asset('assets/js/admin-custom.js')}}"></script>
    <script src="{{asset('js/loader.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        var _token = '{{csrf_token()}}';
        toastr.options = {
            "closeButton": true,
            "debug": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-full-width",
            "preventDuplicates": true,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
    @yield('javascript')
</body>

</html>
