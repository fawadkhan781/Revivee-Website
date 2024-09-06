<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content=""/>
    <meta name="description" content="Using Atlantis RCM enjoy a full range of medical billing solutions so that you and your practice can fully equip yourself while providing quality patient care"/>
    <meta name="viewport" content=" width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Profitability with medical billing and credentialing solutions</title>
    <!-- favicon icon -->
    <link rel="shortcut icon" href="{{asset('/public/assets/images/FAV-ICON.svg')}}" />
    <!-- bootstrap -->
    @include('front_end.layout.headers')
    <link rel="stylesheet" href="{{asset('public/assets/css/wizard.css')}}">
    @yield('header-scripts')
</head>
<body style="background-color: #f9fcfc;">
<!--page start-->
<div class="page">
    <nav class="navbar atlantis_rcm_nav navbar-light navbar-expand-lg">
        <div class="container-fluid container" id="nav_div">
            <a class="navbar-brand" href="{{'/'}}"><img src="{{url('public/assets/images/new_theme/head_logo.png')}}" alt=""></a>
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul id="nav" class="navbar-nav justify-content-end align-items-center w-100">
                    <li class="nav-item">
                        <a class="nav-link text-center {{ (request()->is('/')) ? 'active' : '' }}" aria-current="page" href="https://atlantisrcm.com/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center {{ (request()->is('about_us')) ? 'active' : '' }}" href="https://atlantisrcm.com/about_us">About Atlantis</a>
                    </li>
                    <div class="nav-item dropdown d-block d-lg-none">
                        <button class="btn mt-2 btn_mbl_drpdown w-100 dropdown-toggle {{ (request()->is('absolute_revenue')) ? 'btn_mbl_drpdown_active' : '' }} " type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                            Solutions
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                            <li><a class="dropdown-item text-center {{ (request()->is('absolute_revenue')) ? 'active' : '' }}" href="{{url('absolute_revenue')}}">Revenue Cycle Management</a></li>
                            <li><a class="dropdown-item text-center {{ (request()->is('healthC_analytics')) ? 'active' : '' }} " href="{{url('healthC_analytics')}}">Health Care Analytics</a></li>
                            <li><a class="dropdown-item text-center {{ (request()->is('practice_manage')) ? 'active' : '' }} " href="{{url('practice_manage')}}">Practice Management</a></li>
                            <li><a class="dropdown-item text-center {{ (request()->is('telehealth')) ? 'active' : '' }} " href="{{url('telehealth')}}">Telehealth</a></li>
                            <li><a class="dropdown-item text-center {{ (request()->is('patient_experience')) ? 'active' : '' }} " href="{{url('patient_experience')}}">Patient Experience Management</a></li>
                            <li><a class="dropdown-item text-center {{ (request()->is('workforce')) ? 'active' : '' }} " href="{{url('workforce')}}">Work Force Extension</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-center {{ (request()->is('all_solutions')) ? 'active' : '' }} " href="{{url('all_solutions')}}">View All Solutions</a></li>
                            <li><a class="dropdown-item text-center {{ (request()->is('tailored_solution')) ? 'active' : '' }} " href="{{url('laboratry')}}">View All Specialties</a></li>
                        </ul>
                    </div>
                    <li class="nav-item d-none d-lg-block" id="solution_menu">
                        <a class="nav-link text-center
                    {{ (request()->is('workforce')) ? 'active' : '' }}
                    {{ (request()->is('absolute_revenue')) ? 'active' : '' }}
                    {{ (request()->is('practice_manage')) ? 'active' : '' }}
                    {{ (request()->is('healthC_analytics')) ? 'active' : '' }}
                    {{ (request()->is('telehealth')) ? 'active' : '' }}
                    {{ (request()->is('patient_experience')) ? 'active' : '' }}
                    {{ (request()->is('all_solutions')) ? 'active' : '' }}
                    {{ (request()->is('texo_about_us')) ? 'active' : '' }}
                    " href="javascript:">Solutions <i class="fas fw-bold fa fa-angle-down"></i></a>
                        <div class="sub_menu_solution">
                            <div class="row">
                                <div class="col-9">
                                    <div class="bg-sol-sb-menu">
                                        <img class="polygon_arrow"  src="{{url('public/assets/images/new_theme/menu/polygon-1.png')}}" alt="">
                                        <div class="row my-2 px-3">
                                            <div class="col-6">
                                                <a href="https://atlantisrcm.com/absolute_revenue">
                                                    <div class="d-flex align-items-center m-3 my-4">
                                                        <img src="https://atlantisrcm.com/public/frontend/assets/img/menu/1-icon_rcm.png" alt="">
                                                        <div class="mx-2">
                                                            <p class="text-light m-0 sub_menu_title">Revenue Cycle Management</p>
                                                            <p class="text-light m-0 sub_menu_descrip">Emphasis on accurate data</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="https://atlantisrcm.com/practice_manage">
                                                    <div class="d-flex align-items-center m-3 my-4">
                                                        <img src="https://atlantisrcm.com/public/frontend/assets/img/menu/2-icon_practise_management.png" alt="">
                                                        <div class="mx-2">
                                                            <p class="text-light m-0 sub_menu_title">Practice Management</p>
                                                            <p class="text-light m-0 sub_menu_descrip">Coordinated and improved workflow</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="https://atlantisrcm.com/healthC_analytics">
                                                    <div class="d-flex align-items-center m-3 my-4">
                                                        <img src="https://atlantisrcm.com/public/frontend/assets/img/menu/3-icon_telehealth.png" alt="">
                                                        <div class="mx-2">
                                                            <p class="text-light m-0 sub_menu_title">Health Care Analytics</p>
                                                            <p class="text-light m-0 sub_menu_descrip">Reducing errors with accurate data</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="https://atlantisrcm.com/telehealth">
                                                    <div class="d-flex align-items-center m-3 my-4">
                                                        <img src="https://atlantisrcm.com/public/frontend/assets/img/menu/4-icon_health_care_analytics.png" alt="">
                                                        <div class="mx-2">
                                                            <p class="text-light m-0 sub_menu_title">Telehealth</p>
                                                            <p class="text-light m-0 sub_menu_descrip">Better coordinated healthcare</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="https://atlantisrcm.com/patient_experience">
                                                    <div class="d-flex align-items-center m-3 my-4">
                                                        <img src="https://atlantisrcm.com/public/frontend/assets/img/menu/5-Icon_patient_experience_management.png" alt="">
                                                        <div class="mx-2">
                                                            <p class="text-light m-0 sub_menu_title">Patient Experience Management</p>
                                                            <p class="text-light m-0 sub_menu_descrip">Scores higher on patient satisfaction</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="https://atlantisrcm.com/workforce">
                                                    <div class="d-flex align-items-center m-3 my-4">
                                                        <img src="https://atlantisrcm.com/public/frontend/assets/img/menu/6-icon_workforce_extension.png" alt="">
                                                        <div class="mx-2">
                                                            <p class="text-light m-0 sub_menu_title">Work Force Extension</p>
                                                            <p class="text-light m-0 sub_menu_descrip">Ensures smooth operations</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <a href="https://atlantisrcm.com/all_solutions"><button class="sb_menu_view_all_sol mx-5">View All Solutions</button></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="py-4 my-2 grey_article_sb_menu">
                                        <h6 class="text-grey fw-bold m-3">
                                            Specialties
                                        </h6>
                                        <a href="https://atlantisrcm.com/laboratry">
                                            <p  class="text-grey sub_menu_descrip">
                                                Laboratory
                                            </p>
                                        </a>
                                        <a href="https://atlantisrcm.com/homehealth">

                                            <p  class="text-grey sub_menu_descrip">
                                                Home Health
                                            </p>
                                        </a>
                                        <a href="https://atlantisrcm.com/dmeProviders">
                                            <p  class="text-grey sub_menu_descrip">
                                                DME Providers
                                            </p>
                                        </a>
                                        <a href="https://atlantisrcm.com/laboratry" >
                                            <p  class="text-seafoam sub_menu_descrip" style="margin-bottom: 35px !important;">
                                                View All<i class="fa fa-angles-right"></i>
                                            </p>
                                        </a>
                                        <a href="https://atlantisrcm.com/unyeild_commitment">
                                            <p  class="text-grey sub_menu_descrip mt-5">
                                                Large Medical Groups
                                            </p>
                                        </a>
                                        <a href="https://atlantisrcm.com/texo_about_us">
                                            <p  class="text-grey sub_menu_descrip my-4">
                                                Small Medical Practices
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center {{ (request()->is('medical_billing')) ? 'active' : '' }}" href="https://atlantisrcm.com/medical_billing">Medical Billing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center {{ (request()->is('medical_credentialing')) ? 'active' : '' }}" href="https://atlantisrcm.com/medical_credentialing">Credentialing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center {{ (request()->is('contact_us')) ? 'active' : '' }}" href="https://atlantisrcm.com/contact_us">Contact Us</a>
                    </li>
                    <li class="nav-item">
{{--                        <a class="nav-link text-center {{ (request()->is('login')) ? 'active' : '' }}" href="https://customeratlantisrcm.com/login" target="_blank">Login</a>--}}
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sub Header -->
    <section class="insurance_company_header">
        <div class="container">
            <nav class="navbar navbar-expand-lg ">
                <div>
                    <a class="dropdown-toggle text-light d-lg-none" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="fa fa-user text-white"></i>
                    </a>
                    <ul class="dropdown-menu nav-content">
                        <li><a class="dropdown-item" href="#">Signout</a></li>
                    </ul>
                    <a class=""><i class="fa fa-bell text-white"></i></a>
                    <a class="mx-3"><i class="fa fa-gear text-white"></i></a>
                </div>
                <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-list"></i>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-lg-3">
                        <li class="nav-item">
                            <a class="nav-link active text-light" aria-current="page" href="#"> Invite Doctors </a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link text-light" href="{{route('user_timeline')}}">Upcoming Schedule</a>--}}
{{--                        </li>--}}
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{Auth::user()->role_id!=3? (count(Auth::user()->group_credential) > 0?route('group_dashboard'):route('user_dashboard')):route('billing_user_dashboard')}}">{{Auth::user()->full_name}}</a>
                        </li>
                        <li class="nav-item dropdown d-none d-lg-block">
                            <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                <i class="fa fa-user-circle text-white"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('logout')}}">Signout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>
    @yield('content')
    <footer class="clearfix footer w-100 widget-footer d-none" style="bottom: 0; background-color: #1166e1">
        <div class="row copyright">
            <div class="col-md-12">
                <div class="text-center text-light">
                    <span>Copyright © 2022 <a href="{{ url('/') }}">Atlantis RCM</a>. All Rights Reserved</span>
                </div>
            </div>
        </div>
    </footer>
    <!--back-to-top end-->
</div><!-- page end -->
<!-- Javascript -->
@include('front_end.layout.footer_js')
@yield('footer-scripts')
</body>

</html>
