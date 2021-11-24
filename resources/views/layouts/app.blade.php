<!doctype html>
<html lang="en">

<head>
    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="Templist - HTML5 Premium Digital goods marketplace directory jquery css responsive website Template" name="description">
    <meta content="Spruko Technologies Private Limited" name="author">
    <meta name="keywords" content="digital goods, digital marketplace, easy digital downloads, marketplace website, multi vendor, online marketplace, digital download, marketplace, best marketplace, best marketplace websites, building an online marketplace, digital goods marketplace, digital product marketplace, internet marketplace, marketplace html template, marketplace template, marketplace website template, online marketplace to sell, web marketplace, bootstrap 4 marketplace template, bootstrap marketplace, bootstrap marketplace template, digital marketplace html template, html marketplace template, marketplace bootstrap template, marketplace template bootstrap, marketplace template html, multi vendor html template, template marketplace bootstrap" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Favicon -->
    <link rel="icon" href="{{asset('assets/images/brand/favicon.ico')}}" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/brand/favicon.ico')}}" />

    <!-- Title -->
    <title>Templist - HTML5 Premium Digital goods marketplace directory jquery css responsive website Template</title>

    <!-- Bootstrap css -->
    <link href="{{asset('assets/plugins/bootstrap-4.3.1/css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- Style css -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/skin-modes.css')}}" rel="stylesheet" />

    <!-- Font-awesome  css -->
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" />

    <!--Select2 css -->
    <link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />

    <!-- Cookie css -->
    <link href="{{asset('assets/plugins/cookie/cookie.css')}}" rel="stylesheet">

    <!-- Owl Theme css-->
    <link href="{{asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />

    <!-- Custom scroll bar css-->
    <link href="{{asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.css')}}" rel="stylesheet" />

    <!-- Auto Complete css -->
    <link href="{{asset('assets/plugins/autocomplete/jquery.autocomplete.css')}}" rel="stylesheet">

    <!--Image-tooltip css-->
    <link href="{{asset('assets/plugins/image-tooltip/image-tooltip.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet" />

    <!-- Color Skin css -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('assets/color-skins/color6.css')}}" />
</head>

<body class="headerstyle1">

    <div id="global-loader">
        <img src="{{asset('assets/images/loader.svg')}}" class="loader-img" alt="img">
    </div>
    <div class="cover-image bg-background3">
        <!--Topbar-->
        <div class="header-main">
            <div class="top-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-sm-4 col-7">
                            <div class="top-bar-left d-flex">
                                <div class="clearfix">
                                    <ul class="socials">
                                        <li>
                                            <a class="social-icon text-dark" href="#"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a class="social-icon text-dark" href="#"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a class="social-icon text-dark" href="#"><i class="fa fa-linkedin"></i></a>
                                        </li>
                                        <li>
                                            <a class="social-icon text-dark" href="#"><i class="fa fa-google-plus"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @guest
                        <div class="col-xl-4 col-lg-4 col-sm-8 col-5">
                            <div class="top-bar-right">
                                <ul class="custom">
                                    <li>
                                        <a href="{{route('login')}}" class="text-dark"><i class="fa fa-sign-in mr-1"></i> <span>Login</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @endguest
                    </div>
                </div>
            </div>
            <!--/Topbar-->

            <!--Header-->
            <header class="header-search header-logosec p-2 header-icons">
                <div class="container">
                    <div class="d-flex">
                        <div class="header-search-logo d-none d-lg-block">
                            <a href="/">
                                <img src="{{asset('HajMaLabLogo.png')}}" alt="" style="width: 200px;">
                            </a>
                        </div>
                        @auth
                        <div class="d-flex ml-auto header-right-icons header-search-icon">
                            <div class="dropdown d-md-flex notifications">
                                <?php

                                $carts =  Illuminate\Support\Facades\DB::table('carts')
                                    ->select(
                                        'carts.id',
                                        'carts.user_id',
                                        'carts.project_id',
                                        'projects.name',
                                        'projects.slug',
                                        'price',
                                        'sale_price',
                                        'projects.cover_id',
                                        Illuminate\Support\Facades\DB::raw("(SELECT name FROM categories WHERE id = projects.category_id) as  category"),
                                        Illuminate\Support\Facades\DB::raw("(SELECT type FROM categories WHERE id = projects.category_id) as  category_type"),
                                        Illuminate\Support\Facades\DB::raw("(SELECT file FROM files WHERE project_id = projects.id AND id = projects.cover_id) as cover"),
                                        Illuminate\Support\Facades\DB::raw("(SELECT type FROM categories WHERE id = projects.category_id) as  category_type"),
                                    )
                                    ->leftJoin('projects', 'projects.id', '=', 'carts.project_id')
                                    ->leftJoin('categories', 'categories.id', '=', 'projects.category_id')
                                    ->where("carts.user_id", Illuminate\Support\Facades\Auth::id())
                                    ->get();
                                ?>
                                <a class="nav-link icon" data-toggle="dropdown">
                                    <i class="fe fe-shopping-cart"></i>
                                    <span class="nav-unread badge badge-danger badge-pill cart_number">{{count($carts)}}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow cart-dropdown">
                                    <div class="drop-cart header-dropdown-list cart_lists">
                                        @forelse ($carts as $cart)
                                        <div class="{{$loop->last ? '' : 'border-bottom'}} cart-item" id="{{$cart->id}}">
                                            <div class="d-flex pl-3 pr-4 pt-2 pb-3 align-items-center">
                                                <div>
                                                    @if($cart->cover == null || $cart->cover =='')
                                                    @if($cart->category_type == 'audio')
                                                    <img src="{{asset('assets/images/media/pictures/audio.jpg')}}" class="br-4" style="height:55px; width:100%; object-fit:cover;" alt="{{$cart->name}}">
                                                    @elseif($cart->category_type == 'video')
                                                    <img src="{{asset('assets/images/media/pictures/04.jpg')}}" class="br-4" alt="{{$cart->name}}" style="height:55px; width:100%; object-fit:cover;">
                                                    @endif
                                                    @else
                                                    <img src="{{$cart->cover}}" class="br-4" alt="{{$cart->name}}" style="height:55px; width:100%; object-fit:cover;">
                                                    @endif
                                                </div>
                                                <div class="d-flex">
                                                    <div class="pl-3">
                                                        <span class="fs-16 h4 d-block">{{$cart->name}}</span>
                                                        <div class="fs-13 text-muted">{{$cart->category}}</div>
                                                    </div>
                                                </div>
                                                <div class="ml-auto text-center">
                                                    <a href="#" class="text-muted cart_remove_btn"><i class="fe fe-trash-2 fs-13"></i></a>
                                                    <div class="h5 text-dark mt-1 mb-0">${{$cart->sale_price}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="empty-cart">
                                            <div class="d-flex pl-3 pr-4 pt-2 pb-3 align-items-center">
                                                <h4 class="text-dark">Item not found ...</h4>
                                            </div>
                                        </div>
                                        @endforelse

                                    </div>
                                    <div class="dropdown-footer">
                                        <div class="btn-list">
                                            <a href="{{route('cart')}}" class="btn btn-primary  ripple mb-lg-0">View Cart</a>
                                            <a href="{{route('checkout')}}" class=" btn btn-secondary  ripple mb-lg-0">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- NOTIFICATIONS -->
                            <div class="dropdown d-md-flex notifications">
                                <a class="nav-link icon" data-toggle="dropdown">
                                    <i class="fe fe-bell"></i>
                                    <span class="pulse bg-success"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <div class="notifications-menu header-dropdown-list">
                                        <a href="#" class="dropdown-item d-flex">
                                            <div class="text-primary fs-18 mr-3 ">
                                                <i class="fe fe-mail text-primary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-1">Commented on your post.</h6>
                                                <div class="small text-muted">3 hours ago</div>
                                            </div>
                                        </a>
                                        <a href="#" class="dropdown-item d-flex border-top">
                                            <div class="text-secondary fs-18 mr-3 ">
                                                <i class="fe fe-user text-secondary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-1">New User Registered.</h6>
                                                <div class="small text-muted">1 day ago</div>
                                            </div>
                                        </a>
                                        <a href="#" class="dropdown-item d-flex border-top">
                                            <div class="text-success fs-18 mr-3 ">
                                                <i class="fe fe-thumbs-up text-success"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-1">Someone likes our posts</h6>
                                                <div class="small text-muted">5 mins ago</div>
                                            </div>
                                        </a>
                                        <a href="#" class="dropdown-item d-flex border-top">
                                            <div class="text-purple fs-18 mr-3 ">
                                                <i class="fe fe-upload text-purple"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-1">New file has been uploaded</h6>
                                                <div class="small text-muted">50 sec ago</div>
                                            </div>
                                        </a>
                                        <a href="#" class="dropdown-item d-flex border-top">
                                            <div class="text-danger fs-18 mr-3 ">
                                                <i class="fe fe-alert-circle text-danger"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-1">System alert</h6>
                                                <div class="small text-muted">2 days ago</div>
                                            </div>
                                        </a>
                                        <a href="#" class="dropdown-item d-flex border-top">
                                            <div class="text-warning fs-18 mr-3 ">
                                                <i class="fe fe-server text-warning"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-1">Server Rebooted</h6>
                                                <div class="small text-muted">45 mins ago</div>
                                            </div>
                                        </a>
                                        <a href="#" class="dropdown-item d-flex border-top">
                                            <div class="text-secondary fs-18 mr-3 ">
                                                <i class="fe fe-layers text-secondary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-1">Completed One task</h6>
                                                <div class="small text-muted">3 mins ago</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="dropdown-footer p-3">
                                        <a href="#" class="fs-14 text-dark text-center">View all Notification</a>
                                    </div>
                                </div>
                            </div><!-- NOTIFICATIONS -->
                            <div class="dropdown d-md-flex message">
                                <a class="nav-link icon text-center" data-toggle="dropdown">
                                    <i class="fe fe-mail"></i>
                                    <span class="nav-unread badge badge-info badge-pill">3</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <div class="message-menu header-dropdown-list">
                                        <a class="dropdown-item border-bottom" href="#">
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <span class="avatar avatar-md brround align-self-center cover-image" data-image-src="{{asset('assets/images/users/male/1.jpg')}}"></span>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="pl-3">
                                                        <span class="font-weight-semibold">Jack Wright</span> all the best your template awesome
                                                        <div class="small text-muted">
                                                            3 hours ago
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item border-bottom">
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <span class="avatar avatar-md brround  align-self-center cover-image" data-image-src="{{asset('assets/images/users/female/1.jpg')}}"></span>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="pl-3">
                                                        <span class="font-weight-semibold">Lisa Rutherford</span> Hey! there I'm available
                                                        <div class="small text-muted">
                                                            5 hour ago
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item border-bottom">
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <span class="avatar avatar-md brround  align-self-center cover-image" data-image-src="{{asset('assets/images/users/male/2.jpg')}}"></span>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="pl-3">
                                                        <span class="font-weight-semibold">Blake Walker</span> just created a new blog post
                                                        <div class="small text-muted">
                                                            45 mintues ago
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item border-bottom">
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <span class="avatar avatar-md brround align-self-center cover-image" data-image-src="{{asset('assets/images/users/female/2.jpg')}}"></span>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="pl-3">
                                                        <span class="font-weight-semibold">Fiona Morrison</span> added new comment on your photo
                                                        <div class="small text-muted">
                                                            2 days ago
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item border-bottom">
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <span class="avatar avatar-md brround  align-self-center cover-image" data-image-src="{{asset('assets/images/users/male/4.jpg')}}"></span>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="pl-3">
                                                        <span class="font-weight-semibold">Stewart Bond</span> your payment invoice is generated
                                                        <div class="small text-muted">
                                                            3 days ago
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item border-bottom">
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <span class="avatar avatar-md brround  align-self-center cover-image" data-image-src="{{asset('assets/images/users/female/5.jpg')}}"></span>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="pl-3">
                                                        <span class="font-weight-semibold">Faith Dickens</span> please check your mail....
                                                        <div class="small text-muted">
                                                            4 days ago
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item text-center">See all Messages</a>
                                </div>
                            </div><!-- MESSAGE-BOX -->
                            <div class="dropdown d-md-flex profile-1">
                                <a class="nav-link icon text-center" data-toggle="dropdown">
                                    <i class="fe fe-user"></i>
                                    <span class="pulse bg-success"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <div class="drop-heading">
                                        <div class="text-center">
                                            <h5 class="text-dark mb-1">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h5>
                                            <small class="text-muted fs-16 text-primary font-weight-semibold">${{Auth::user()->money}}</small>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    @if(Auth::user()->seller == 1)
                                    <a class="dropdown-item" href="{{route('dashboard')}}">
                                        <i class="dropdown-icon   fe fe-airplay"></i>My Dashboard
                                    </a>
                                    @endif
                                    <a class="dropdown-item" href="{{route('user_profile_edit',auth()->user()->username)}}">
                                        <i class="dropdown-icon ti-write"></i>Edit Profile
                                    </a>

                                    <a class="dropdown-item" href="myads.html">
                                        <i class="dropdown-icon  fe fe-codepen"></i> My Items
                                    </a>
                                    <a class="dropdown-item" href="myfavorite.html">
                                        <span class="float-right"></span>
                                        <i class="dropdown-icon ti-heart"></i> My Favorite
                                    </a>
                                    <a class="dropdown-item" href="manged.html">
                                        <i class="dropdown-icon ti-palette"></i> Managed Items
                                    </a>
                                    <a class="dropdown-item" href="payments.html">
                                        <i class="dropdown-icon ti-credit-card"></i> Payments
                                    </a>
                                    <a class="dropdown-item" href="orders.html">
                                        <i class="dropdown-icon ti-shopping-cart"></i> Orders
                                    </a>
                                    <a class="dropdown-item" href="statements.html">
                                        <i class="dropdown-icon ti-filter"></i> Statements
                                    </a>
                                    <a class="dropdown-item" href="tips.html">
                                        <i class="dropdown-icon ti-harddrive"></i> Safety Tips
                                    </a>
                                    <a class="dropdown-item" href="settings.html">
                                        <i class="dropdown-icon ti-settings"></i> Settings
                                    </a>
                                    <div class="dropdown-divider mt-0"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="dropdown-icon ti-unlock"></i> Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endauth
                    </div>
                </div>
            </header>
            <!--/Header-->

            <!-- Mobile Header -->
            <div class="horizontal-header clearfix ">
                <div class="container">
                    <a id="horizontal-navtoggle" class="animated-arrow"><span></span></a>
                    <span class="smllogo"><img src="{{asset('assets/images/brand/logo1.png')}}" width="120" alt="img" /></span>
                    <span class="smllogo-white"><img src="{{asset('assets/images/brand/logo.png')}}" width="120" alt="img" /></span>
                    <a href="tel:245-6325-3256" class="callusbtn"><i class="fa fa-phone" aria-hidden="true"></i></a>
                </div>
            </div>
            <!-- /Mobile Header -->

            <!--Horizontal-main -->
        </div>
        <!--/Horizontal-main -->

        <!-- Section -->
        @yield('header')
    </div><!-- /Section -->
    <!-- End Popup Intro-->
    @yield('content')
    <!--Footer Section-->
    <section>
        <footer class="bg-dark text-white">
            <div class="footer-main">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-12">
                            <h6>About</h6>
                            <hr class="deep-purple  accent-2 mb-4 mt-0 d-inline-block mx-auto">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit amet numquam iure provident voluptate essequasi, veritatis totam voluptas nostrum.Lorem ipsum dolor sit amet, consectetur </p>
                            <ul class="list-unstyled list-inline mt-3">
                                <li class="list-inline-item">
                                    <a class="btn ripple btn-floating btn-sm mx-1">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn ripple btn-floating btn-sm mx-1">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn ripple btn-floating btn-sm mx-1">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn ripple btn-floating btn-sm mx-1">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-2 col-md-12">
                            <h6>Our Services</h6>
                            <hr class="deep-purple text-primary accent-2 mb-4 mt-0 d-inline-block mx-auto">
                            <ul class="list-unstyled mb-0">
                                <li><a href="javascript:;">Our Team</a></li>
                                <li><a href="javascript:;">Contact US</a></li>
                                <li><a href="javascript:;">About</a></li>
                                <li><a href="javascript:;">Services</a></li>
                                <li><a href="javascript:;">Blog</a></li>
                                <li><a href="javascript:;">Terms and Services</a></li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-md-12">
                            <h6>Contact</h6>
                            <hr class="deep-purple  text-primary accent-2 mb-4 mt-0 d-inline-block mx-auto">
                            <ul class="footer-conatct list-unstyled mb-0 contact-footer">
                                <li>
                                    <a href="#"><i class="fa fa-home mr-3 text-white"></i> 22 S. Rock Creek StreetSan Carlos, Uniontown CA 94070, USA</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-envelope mr-3 text-white"></i> info12323@example.com</a></li>
                                <li>
                                    <a href="#"><i class="fa fa-phone mr-3 text-white"></i> + 01 234 567 88</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-print mr-3 text-white"></i> + 01 234 567 89</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <h6>Subscribe</h6>
                            <hr class="deep-purple  text-primary accent-2 mb-4 mt-0 d-inline-block mx-auto">
                            <div class="clearfix"></div>
                            <div class="input-group w-100">
                                <input type="text" class="form-control br-tl-3  br-bl-3 " placeholder="Email">
                                <div class="input-group-append ">
                                    <button type="button" class="btn ripple  btn-primary br-tr-3  br-br-3"> Subscribe </button>
                                </div>
                            </div>
                            <h6 class="mb-0 mt-5">Payments</h6>
                            <hr class="deep-purple  text-primary accent-2 mb-2 mt-3 d-inline-block mx-auto">
                            <div class="clearfix"></div>
                            <ul class="footer-payments">
                                <li class="pl-0"><a href="javascript:;"><i class="fa fa-cc-amex" aria-hidden="true"></i></a></li>
                                <li><a href="javascript:;"><i class="fa fa-cc-visa" aria-hidden="true"></i></a></li>
                                <li><a href="javascript:;"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></a></li>
                                <li><a href="javascript:;"><i class="fa fa-cc-mastercard" aria-hidden="true"></i></a></li>
                                <li><a href="javascript:;"><i class="fa fa-cc-paypal" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-dark text-white-50 p-0">
                <div class="container">
                    <div class="row d-flex">
                        <div class="col-lg-12 col-sm-12 mt-3 mb-3 text-center">
                            Copyright © 2020 <a href="#" class="fs-14 text-primary">Templist</a>. Designed by <a href="#" class="fs-14 text-primary"> Spruko Technologies Pvt.Ltd </a>All rights reserved.
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </section>
    <!--Footer Section-->

    <!-- Back to top -->
    <a href="#top" id="back-to-top"><i class="fa fa-long-arrow-up"></i></a>

    <!-- JQuery js-->
    <!-- <script src="{{asset('assets/js/jquery-3.2.1.min.js')}}"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap js -->
    <script src="{{asset('assets/plugins/bootstrap-4.3.1/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-4.3.1/js/bootstrap.min.js')}}"></script>

    <!--JQuery IT Itemsrkline js-->
    <script src="{{asset('assets/js/jquery.sparkline.min.js')}}"></script>

    <!-- Circle Progress js-->
    <script src="{{asset('assets/js/circle-progress.min.js')}}"></script>

    <!-- Star Rating Js-->
    <script src="{{asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>

    <!--Owl Carousel js -->
    <script src="{{asset('assets/plugins/owl-carousel/owl.carousel.js')}}"></script>

    <!--Horizontal Menu js-->
    <script src="{{asset('assets/plugins/horizontal-menu/horizontal-menu.js')}}"></script>

    <!--Counters js-->
    <script src="{{asset('assets/plugins/counters/counterup.min.js')}}"></script>
    <script src="{{asset('assets/plugins/counters/waypoints.min.js')}}"></script>
    <script src="{{asset('assets/plugins/counters/numeric-counter.js')}}"></script>

    <!--JQuery TouchSwipe js-->
    <script src="{{asset('assets/js/jquery.touchSwipe.min.js')}}"></script>

    <!--Select2 js -->
    <script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/select2.js')}}"></script>

    <!-- Cookie js -->
    <script src="{{asset('assets/plugins/cookie/jquery.ihavecookies.js')}}"></script>
    <script src="{{asset('assets/plugins/cookie/cookie.js')}}"></script>

    <!-- Count Down js-->
    <script src="{{asset('assets/plugins/count-down/jquery.lwtCountdown-1.0.js')}}"></script>

    <!-- Custom scroll bar js-->
    <script src="{{asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.js')}}"></script>

    <!--Auto Complete js -->
    <script src="{{asset('assets/plugins/autocomplete/jquery.autocomplete.js')}}"></script>
    <script src="{{asset('assets/plugins/autocomplete/autocomplete.js')}}"></script>

    <!-- Image-tooltip js -->
    <script src="{{asset('assets/plugins/image-tooltip/image-tooltip.js')}}"></script>

    <!-- sticky js-->
    <script src="{{asset('assets/js/sticky.js')}}"></script>

    <!-- Swipe js-->
    <script src="{{asset('assets/js/swipe.js')}}"></script>

    <!-- Scripts js-->
    <script src="{{asset('assets/js/owl-carousel.js')}}"></script>

    <!--Showmore js-->
    <script src="{{asset('assets/js/jquery.showmore.js')}}"></script>
    <script src="{{asset('assets/js/showmore.js')}}"></script>
    <script src="{{asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>

    <!-- Custom Js-->
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script src="http://malsup.github.io/jquery.blockUI.js"> </script>

    <script src="{{asset('assets/js/card.js')}}"></script>
    <script src="{{asset('assets/js/loader.js')}}"></script>
    <script>
        var token = "{{ csrf_token() }}";
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    @yield('javascript')
</body>

</html>
