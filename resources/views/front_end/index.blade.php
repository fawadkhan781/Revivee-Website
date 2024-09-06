@extends('front_end.layout.main')
@section('content')
        <!--header start-->
        <header id="masthead" class="header ttm-header-style-03">
            <!-- site-header-menu -->
            <div id="site-header-menu" class="site-header-menu">
                <div class="site-header-menu-inner ttm-stickable-header">
                    <div class="container">
                        <div class="d-xl-flex flex-xl-row align-items-xl-center justify-content-xl-between">
                            <!-- site-branding -->
                            <div class="site-branding d-flex">
                                <a class="home-link" href="{{ url('/') }}" title="Atlantis_rcm" rel="home">
                                    <img id="logo-img" class="img-fluid auto_size logo-img desktop_logo" height="160" width="110" src="{{asset('/public/assets/front_end/images/AtlantisLogo_White.svg')}}" alt="logo-img">
                                    <img id="logo-img" class="img-fluid auto_size logo-img tab_mobile_logo" height="160" width="110" src="{{asset('/public/assets/front_end/images/RCM-Logo.svg')}}" alt="logo-img">
                                </a>
                            </div><!-- site-branding end -->
                            <!--site-navigation -->
                            <div id="site-navigation" class="site-navigation">
                                <div class="btn-show-menu-mobile menubar menubar--squeeze">
                                    <span class="menubar-box">
                                        <span class="menubar-inner"></span>
                                    </span>
                                </div>
                                <div class="top_bar d-flex align-items-center justify-content-end">
                                    <div class="top_bar_contact_item text-light">
                                        <div class="top_bar_icon">
                                            <i class="fa fa-map-marker light-blue-color"></i>
                                        </div>447 Broadway, 2nd Floor Suite #507, New York, 10013
                                    </div>
                                    <div class="top_bar_contact_item ">
                                        <div class="top_bar_icon"><i class="fa fa-envelope-o light-blue-color"></i></div><a class="text-light" href="mailto:info@atlantisrcm.com">info@atlantisrcm.com</a>
                                    </div>
                                    <div class="top_bar_contact_item text-light">
                                        <div class="top_bar_icon"><i class="fa fa-clock-o light-blue-color"></i></div>Office Hour: 08:00am - 6:00pm (EST)
                                    </div>
                                    <div class="top_bar_contact_item top_bar_social">
                                        <ul class="social-icons">
                                            <li class="facebook-icon"><a href="https://www.facebook.com/Atlantis-RCM-111413964964199" rel="noopener" aria-label="facebook"><i class="fa fa-facebook"></i></a></li>
                                            <li class="twitter-icon"><a href="https://twitter.com/AtlantisRcm" rel="noopener" aria-label="twitter"><i class="fa fa-twitter"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center justify-content-end">
                                    <!-- menu -->
                                    <nav class="main-menu menu-mobile d-xl-flex align-items-center justify-content-start" id="menu">
                                        <ul class="menu">
                                            <li class="mega-menu-item active">
                                                <a href="{{ route('/') }}" class="mega-menu-link">Home</a>
                                            </li>
                                            <li class="mega-menu-item">
                                                <a href="javascript:;" class="mega-menu-link">About</a>
                                                <ul class="mega-submenu">
                                                    <li><a href="javascript:scroll_to('#abt_atlantis_rcm',100)">About Atlantis RCM</a></li>
                                                    <li><a href="javascript:scroll_to('#abt_rcm',50)">About RCM</a></li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-item">
                                                <a href="javascript:scroll_to('#med_credetial', 50)" class="mega-menu-link">Medical Credentialing</a>
                                            </li>
                                            <li class="mega-menu-item">
                                                <a href="javascript:scroll_to('#med_billing', 50)" class="mega-menu-link">Medical Billing</a>
                                            </li>
                                            <li class="mega-menu-item">
                                                <a href="javascript:scroll_to('#contact', 200)" class="mega-menu-link">Contact Us</a>
                                            </li>
                                            <li class="mega-menu-item">
                                                @if(Auth::user())
                                                    <li class="mega-menu-item">
                                                        <a href="javascript:;" class="mega-menu-link"><i class="fa fa-user-circle"></i> {{Auth::user()->full_name}}</a>
                                                        <ul class="mega-submenu">
                                                            <li><a href="{{ route('user_form') }}">Credentialing Form</a></li>
                                                            <li><a href="{{ route('logout') }}" class="mega-menu-link">Logout</a></li>
                                                        </ul>
                                                    </li>
                                                @else
                                                <a href="{{ route('login') }}" class="mega-menu-link">Login</a>
                                                @endif
                                            </li>
                                        </ul>
                                    </nav><!-- menu end -->
                                </div>
                            </div><!-- site-navigation end-->
                        </div>
                    </div>
                </div>
            </div><!-- site-header-menu end-->
        </header>
        <!--header end-->
        <!-- START homeclassicmain REVOLUTION SLIDER 6.0.1 -->
        <rs-module-wrap id="rev_slider_1_1_wrapper" data-source="gallery">
            <rs-module id="rev_slider_1_1" style="height: 850px; max-height: 950px;" data-version="6.0.1" class="rev_slider_1_1_height">
                <!-- rs-slides -->
                <rs-slides>
                    <!-- rs-slide -->
                    <rs-slide data-key="rs-1" data-title="Slide" data-thumb="https://via.placeholder.com/1920x1120?text=1920x1048+slider-mainbg-005.jpg" data-anim="  ei:d;eo:d;s:1000;r:0;t:fade;sl:0;">
                        <img src="{{asset('/public/assets/front_end/images/RCM_hdr.jpg')}}" title="home-mainslider-bg001" width="1920" height="850" class="rev-slidebg" data-no-retina>
                        <rs-layer
                            id="slider-1-slide-2-layer-0"
                            data-type="text"
                            data-color="#fff"
                            data-rsp_ch="on"
                            data-xy="x:l,l,c,c;xo:35px,20px,0px,0;yo:310px,230px,80px,70px;"
                            data-text="w:normal;s:62,62,60,30;l:85,85,70,40;fw:800;"
                            data-frame_0="x:50,50,31,19;"
                            data-frame_1="e:Power0.easeIn;st:250;sp:800;sR:250;"
                            data-frame_999="o:0;st:w;sR:7950;"
                            style="font-family: 'Martel', serif;"
                        >Accelerate, Streamline
                        </rs-layer>
                        <rs-layer
                            id="slider-1-slide-2-layer-1"
                            data-type="text"
                            data-color="#fff"
                            data-rsp_ch="on"
                            data-xy="x:l,l,c,c;xo:35px,20px,0px,0;yo:390px,160px,225px,100px;"
                            data-text="w:normal;s:62,62,60,30;l:85,85,70,75;fw:800;"
                            data-frame_0="x:50,50,31,19;"
                            data-frame_1="e:Power0.easeIn;st:250;sp:800;sR:250;"
                            data-frame_999="o:0;st:w;sR:7950;"
                            style="font-family: 'Martel', serif;"
                        >and <span class="light-blue-color"> Maintain Revenue</span>
                        </rs-layer>
                        <rs-layer
                            id="slider-1-slide-2-layer-3"
                            data-type="text"
                            data-color="#fff"
                            data-rsp_ch="on"
                            data-xy="x:l,l,c,c;xo:35px,20px,0px,0;yo:470px,310px,150px,160px;"
                            data-text="w:normal;s:62,62,60,30;l:85,85,70,40;fw:800;"
                            data-frame_0="x:50,50,31,19;"
                            data-frame_1="e:Power0.easeIn;st:250;sp:800;sR:250;"
                            data-frame_999="o:0;st:w;sR:7950;"
                            style="font-family: 'Martel', serif;"
                        > with Atlantis RCM.
                        </rs-layer>
                        <a
                            id="slider-1-slide-2-layer-4"
                            class="rs-layer ttm-btn ttm-btn-size-sm ttm-btn-shape-round ttm-btn-style-fill ttm-icon-btn-right ttm-btn-color-skincolor"
                            href="javascript:scroll_to('#contact', 200)"
                            target="_self"
                            rel="nofollow"
                            data-type="text"
                            data-rsp_ch="on"
                            data-xy="x:l,l,c,c;xo:35px,20px,0px,0px;y:m;yo:75px,120px,115px,75px;"
                            data-text="w:normal;s:14,14,14,14;l:30,30,30,30;fw:800;a:center;"
                            data-padding="t:7,7,7,7;r:30,30,30,30;b:7,7,7,7;l:30,30,30,30;"
                            data-border="bor:50px,50px,50px,50px;"
                            data-frame_0="y:100%;"
                            data-frame_1="e:power4.inOut;st:820;sp:500;sR:820;"
                            data-frame_999="o:0;st:w;sR:7680;"
                            data-frame_hover="bor:50px,50px,50px,50px;bos:none;"
                            style="z-index:11;background-color:#3767E3 ;font-family: 'Martel', serif;"
                        >Contact US</a>
                    </rs-slide>
                </rs-slides>
            </rs-module><!-- rs-module -->
        </rs-module-wrap>
        <!-- END REVOLUTION SLIDER -->
        <!--site-main start-->
        <div class="site-main">
            <!--about atlantis rcm-->
            <section id="abt_atlantis_rcm" class="ttm-row introduction-section intro_atlantis_rcm clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-xs-12">
                            <div class="pt-15 res-991-pb-40 res-991-pt-0">
                                <!-- section title -->
                                <div class="section-title">
                                    <div class="title-header">
                                        <h3>DELIVERS RELIABLE, PROMPT, END- TO-END SOLUTION</h3>
                                        <h2 class="title">Atlantis Revenue Cycle <span class="ttm-textcolor-skincolor"> Management</span></h2>
                                    </div>
                                    <div class="title-desc">As a Revenue Cycle Management partner, Atlantis eases your compliance burden and drives significant
                                        revenue growth. Keeping your practice in optimal financial health is our priority, and we turn it from a financial
                                        drain to an asset. So that you can concentrate on what really matters: the care of your patients.</div>
                                </div><!-- section title end -->
                                <div class="pb-10">
                                    <p></p>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-md-4 col-sm-6">
                                        <ul class="ttm-list ttm-list-style-icon style2 ttm-textcolor-darkgrey">
                                            <li><i class="fa fa-minus"></i><div class="ttm-list-li-content">Effective Strategy</div></li>
                                            <li><i class="fa fa-minus"></i><div class="ttm-list-li-content">Above & Beyond</div></li>
                                            <li><i class="fa fa-minus"></i><div class="ttm-list-li-content">Full Transparency</div></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-7 col-md-8 col-sm-6">
                                        <ul class="ttm-list ttm-list-style-icon style2 ttm-textcolor-darkgrey res-991-pt-10">
                                            <li><i class="fa fa-minus"></i><div class="ttm-list-li-content">Strategic Advice</div></li>
                                            <li><i class="fa fa-minus"></i><div class="ttm-list-li-content">RCM Experts</div></li>
                                            <li><i class="fa fa-minus"></i><div class="ttm-list-li-content">Powerful Support</div></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="mt-25 res-991-mt-30">
                                    <strong>Don’t hesitate to <u><a href="#contact">Contact Us</a></u> for better help.</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-7 m-auto">
                            <!-- ttm_single_image-wrapper -->
                            <div class="ttm_single_image-wrapper ">
                                <img class="img-fluid shadow_div" src="{{asset('/public/assets/front_end/images/home_page/atlantis_rcm.jpg')}}" alt="">
                            </div>
                        </div>
                    </div><!-- row end -->
                </div>
            </section>
            <section class="ttm-row services-section ttm-bgcolor-grey clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class=" ttm-bgcolor-white spacing-10">
                                <div class="row slick_slider slick_slider-opacity_block slick-arrows-style1" data-slick='{"slidesToShow": 4, "slidesToScroll": 1, "dots":false, "arrows":true, "autoplay":false, "infinite":true,  "responsive":
                                   [{"breakpoint":991,"settings":{"slidesToShow": 2}}, {"breakpoint":575,"settings":{"slidesToShow": 1}}]}'>
                                    <div class="col-lg-3">
                                        <div class="featured-icon-box icon-align-top-content style7">
                                            <div class="featured-icon">
                                                <div class="ttm-icon ttm-icon_element-border ttm-icon_element-style-rounded ttm-icon_element-size-md">
                                                    <div class="d-flex justify-content-center h-100 align-items-center">
                                                        <img  width="50px" src="{{asset('/public/assets/front_end/images/icons/ATLANTIS_RCM/Outsource.png')}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="featured-content">
                                                <div class="featured-title">
                                                    <h3><a href="residential-cleaning.html">Effective Strategy</a></h3>
                                                </div>
                                                <div class="featured-desc">
                                                    <p>Outsource your billing and
                                                        collection to us and reclaim your
                                                        time for managing revenue.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="featured-icon-box icon-align-top-content style7">
                                            <div class="featured-icon">
                                                <div class="ttm-icon ttm-icon_element-border ttm-icon_element-style-rounded ttm-icon_element-size-md">
                                                    <div class="d-flex justify-content-center h-100 align-items-center">
                                                        <img  width="50px" src="{{asset('/public/assets/front_end/images/icons/ATLANTIS_RCM/AbvBynd.png')}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="featured-content">
                                                <div class="featured-title">
                                                    <h3><a href="residential-cleaning.html">Above & Beyond</a></h3>
                                                </div>
                                                <div class="featured-desc">
                                                    <p>Proven practices to streamline
                                                        your billing function and gain
                                                        control of your practice.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="featured-icon-box icon-align-top-content style7">
                                            <div class="featured-icon">
                                                <div class="ttm-icon ttm-icon_element-border ttm-icon_element-style-rounded ttm-icon_element-size-md">
                                                    <div class="d-flex justify-content-center h-100 align-items-center">
                                                        <img  width="50px" src="{{asset('/public/assets/front_end/images/icons/ATLANTIS_RCM/Support.png')}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="featured-content">
                                                <div class="featured-title">
                                                    <h3><a href="residential-cleaning.html">Full Transparency</a></h3>
                                                </div>
                                                <div class="featured-desc">
                                                    <p>Improves client access to
                                                        information by providing timely
                                                        & transparent disclosures.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="featured-icon-box icon-align-top-content style7">
                                            <div class="featured-icon">
                                                <div class="ttm-icon ttm-icon_element-border ttm-icon_element-style-rounded ttm-icon_element-size-md">
                                                    <div class="d-flex justify-content-center h-100 align-items-center">
                                                        <img  width="50px" src="{{asset('/public/assets/front_end/images/icons/ATLANTIS_RCM/AbvBynd.png')}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="featured-content">
                                                <div class="featured-title">
                                                    <h3><a href="residential-cleaning.html">Strategic Advice</a></h3>
                                                </div>
                                                <div class="featured-desc">
                                                    <p>Our professional team
                                                        brings you innovative strategies
                                                        to keep you up to date with
                                                        industry trends.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="featured-icon-box icon-align-top-content style7">
                                            <div class="featured-icon">
                                                <div class="ttm-icon ttm-icon_element-border ttm-icon_element-style-rounded ttm-icon_element-size-md">
                                                    <div class="d-flex justify-content-center h-100 align-items-center">
                                                        <img  width="50px" src="{{asset('/public/assets/front_end/images/icons/ATLANTIS_RCM/RCM-Experts.png')}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="featured-content">
                                                <div class="featured-title">
                                                    <h3><a href="residential-cleaning.html">RCM Experts</a></h3>
                                                </div>
                                                <div class="featured-desc">
                                                    <p>Assist you with all your billing
                                                        & collections needs via our
                                                        billing, remittance, & collection
                                                        professionals.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="featured-icon-box icon-align-top-content style7">
                                            <div class="featured-icon">
                                                <div class="ttm-icon ttm-icon_element-border ttm-icon_element-style-rounded ttm-icon_element-size-md">
                                                    <div class="d-flex justify-content-center h-100 align-items-center">
                                                        <img  width="50px" src="{{asset('/public/assets/front_end/images/icons/ATLANTIS_RCM/Support.png')}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="featured-content">
                                                <div class="featured-title">
                                                    <h3><a href="residential-cleaning.html">Powerful Support</a></h3>
                                                </div>
                                                <div class="featured-desc">
                                                    <p>Prompt service by providing
                                                        knowledgeable and friendly
                                                        representatives every hour of
                                                        the day.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--about atlantis rcm-->
            <!--about RCM-->
            <section id="abt_rcm" class="ttm-row procedure-section-2 ttm-bgcolor-grey bg-img9 ttm-bg ttm-bgimage-yes z-index_1 mt_100 res-991-mt-0 clearfix">
                <div class="ttm-row-wrapper-bg-layer ttm-bg-layer"></div>
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-sm-9 m-auto">
                            <!-- section-title -->
                            <div class="section-title with-sep title-style-center_text">
                                <div class="title-header">
                                    <h2 class="title">What is <span class="ttm-textcolor-skincolor">RCM?</span></h2>
                                </div>
                                <div class="title-desc">Health care organizations utilize Revenue Cycle Management (RCM)
                                    to receive payments, handle billing, and collect revenue.
                                    RCM today encompasses more than just back office operations.
                                    A complete RCM strategy is comprised of three main functions:</div>
                            </div><!-- section-title end -->
                        </div>
                    </div><!-- row end -->
                    <div class="row"><!-- row -->
                        <div class="col-md-4">
                            <!-- featured-imagebox -->
                            <div class="featured-icon-box icon-align-top-content text-center style4">
                                <div class="featured-icon">
                                    <div class="ttm-icon ttm-icon_element-fill ttm-icon_element-color-white ttm-icon_element-size-md ttm-icon_element-style-rounded">
                                        <div class="d-flex justify-content-center h-100 align-items-center">
                                            <img  width="50px" src="{{asset('/public/assets/front_end/images/icons/RCM/Generate.png')}}" alt="">
                                        </div>
                                        <span class="fea-number">01</span>
                                    </div>
                                </div>
                                <div class="featured-content">
                                    <div class="featured-title">
                                        <h3>Generate Revenue:</h3>
                                    </div>
                                    <div class="featured-desc">
                                        <p>To survive, a practice must be able to generate revenue. Scheduling
                                            patient appointments and collecting reimbursements are part of the
                                            process.</p>
                                    </div>
                                </div>
                                <div class="arrow">
                                    <img src="{{asset('/public/assets/front_end/images/arrow-1.png')}}" alt="">
                                </div>
                            </div><!-- featured-imagebox end-->
                        </div>
                        <div class="col-md-4">
                            <!-- featured-imagebox -->
                            <div class="featured-icon-box icon-align-top-content text-center style4">
                                <div class="featured-icon">
                                    <div class="ttm-icon ttm-icon_element-fill ttm-icon_element-color-white ttm-icon_element-size-md ttm-icon_element-style-rounded">
                                        <div class="d-flex justify-content-center h-100 align-items-center">
                                            <img  width="50px" src="{{asset('/public/assets/front_end/images/icons/RCM/Capture.png')}}" alt="">
                                        </div>
                                        <span class="fea-number">02</span>
                                    </div>
                                </div>
                                <div class="featured-content">
                                    <div class="featured-title">
                                        <h3 class="mb-5">Capture Revenue:</h3>
                                    </div>
                                    <div class="featured-desc">
                                        <p>Keeping track of how well a
                                            practice captures revenue is
                                            crucial. To receive payment at
                                            the highest level, proper
                                            documentation is required. </p>
                                    </div>
                                </div>
                                <div class="arrow flip-arrow">
                                    <img src="{{asset('/public/assets/front_end/images/arrow-2.png')}}" alt="">
                                </div>
                            </div><!-- featured-imagebox end-->
                        </div>
                        <div class="col-md-4">
                            <!-- featured-imagebox -->
                            <div class="featured-icon-box icon-align-top-content text-center style4">
                                <div class="featured-icon">
                                    <div class="ttm-icon ttm-icon_element-fill ttm-icon_element-color-white ttm-icon_element-size-md ttm-icon_element-style-rounded">
                                        <div class="d-flex justify-content-center h-100 align-items-center">
                                            <img  width="50px" src="{{asset('/public/assets/front_end/images/icons/RCM/Collect.png')}}" alt="">
                                        </div>
                                        <span class="fea-number">03</span>
                                    </div>
                                </div>
                                <div class="featured-content">
                                    <div class="featured-title">
                                        <h3>Collect Revenue: </h3>
                                    </div>
                                    <div class="featured-desc">
                                        <p>An RCM cycle is rounded out by
                                            back office billing functions.
                                            Billing, posting, and collection of
                                            payments are considered the
                                            final steps in RCM. </p>
                                    </div>
                                </div>
                            </div><!-- featured-imagebox end-->
                        </div>
                    </div>
                </div>
            </section>
            <!--about RCM-->
            <section class="ttm-row broken-section bg-layer-equal-height clearfix">
                <div class="container">
                    <div class="row no-gutters">
                        <div class="col-lg-6">
                            <!-- col-img-img-two -->
                            <div class="col-bg-img-fifteen bg-darkgrey ttm-col-bgimage-yes ttm-bg ttm-left-span spacing-13 z-index-45">
                                <div class="ttm-col-wrapper-bg-layer ttm-bg-layer"></div>
                                <div class="layer-content"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- col-img-img-two -->
                            <div class="ttm-bg ttm-col-bgcolor-yes ttm-right-span spacing-14">
                                <div class="ttm-col-wrapper-bg-layer ttm-bg-layer"></div>
                                <div class="layer-content">
                                    <!-- section title -->
                                    <div class="section-title">
                                        <div class="title-header">
                                            <h2 class="title">How does <span class="ttm-textcolor-skincolor"> RCM differ </span> from traditional billing?</h2>
                                        </div>
                                        <div class="title-desc">
                                            <p>Billing and collection methods have changed over time. Plus, there is an ever-growing pool of payers. While reimbursement
                                                remains a challenge requiring expertise, time, & resources.</p>
                                            <p> Medical professionals have difficulty maximizing profit despite
                                                powerful management software. The solution to this problem lies in revenue cycle management.</p>
                                        </div>
                                    </div><!-- section title end -->
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="featured-icon-box icon-align-before-content ttm-bgcolor-darkgrey style8">
                                                <div class="featured-icon">
                                                    <div class="ttm-icon ttm-icon_element-size-style1">
                                                        <i class="flaticon-question-mark"></i>
                                                    </div>
                                                </div>
                                                <div class="featured-content">
                                                    <div class="featured-title">
                                                        <h3>Atlantis RCM, in that case,
                                                            helps in <span class="light-blue-color font-weight-800">managing</span></h3>
                                                    </div>
                                                    <ul class="ttm-list ttm-list-style-icon">
                                                        <li><i class="fa fa-plus"></i>
                                                            <span class="ttm-list-li-content">Claims</span>
                                                        </li>
                                                        <li><i class="fa fa-plus"></i>
                                                            <span class="ttm-list-li-content">Payment</span>
                                                        </li>
                                                        <li><i class="fa fa-plus"></i>
                                                            <span class="ttm-list-li-content">Billing</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--Building a Partnership With Atlantis RCM SECTION start-->
            <section class="ttm-row introduction-section clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-xs-12">
                            <div class="col-bg-img-ten ttm-col-bgimage-yes ttm-bg ttm-col-bgcolor-yes ml_100">
                                <!--<div class="ttm-col-wrapper-bg-layer ttm-bg-layer">
                                    <div class="ttm-col-wrapper-bg-layer-inner"></div>
                                </div>-->
                                <div class="layer-content">
                                    <div class="pl-100 pt-35 pr-20 res-991-pt-0 res-991-pr-0 res-991-pb-50">
                                        <!-- section title -->
                                        <div class="section-title">
                                            <div class="title-header">
                                                <h3>DELIVERS RELIABLE, PROMPT, END - TO - END SOLUTION</h3>
                                                <h2 class="title pt-3">Building a Partnership With <span class="ttm-textcolor-skincolor">Atlantis RCM</span></h2>
                                            </div>
                                            <div class="title-desc pt-2">Atlantis specializes in generating cash flow for your practice, not just
                                                billing. With deep industry expertise & technology &
                                                Atlantis RCM creates innovative, digitally led transformational
                                                solutions. We offer industry-specific medical billing services,
                                                customer interaction, financial management, accounting, &
                                                analytics.</div>
                                            <br><br>
                                            <div class="title-desc">Through continuous training, Atlantis RCM professionals are
                                                up-to-date on all the latest technologies and compliances,
                                                providing you with efficient insurance claims management.
                                                As regulations, market trends, & technology evolve, we
                                                remain flexible, ensuring you always receive a quality,
                                                efficient service.</div>
                                        </div><!-- section title end -->
                                        <div class="sep_holder_box width-100 mt-20 mb-30">
                                            <span class="sep_holder"><span class="sep_line"></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-10">
                            <!-- ttm_single_image-wrapper -->
                            <div class="ttm_single_image-wrapper text-right">
                                <img class="img-fluid shadow_div" src="{{asset('/public/assets/front_end/images/home_page/partnership.jpg')}}" alt="">
                            </div>
                        </div>
                    </div><!-- row end -->
                </div>
            </section>
            <!--Building a Partnership With Atlantis RCM SECTION end-->
            <!--Medical Credentialing start-->
            <section id="med_credetial" class="ttm-row introduction-section clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-sm-7 m-auto">
                            <!-- ttm_single_image-wrapper -->
                            <div class="ttm_single_image-wrapper position-relative shadow_div">
                                <img class="img-fluid" src="{{asset('/public/assets/front_end/images/home_page/med_credential.jpg')}}" alt="">
                                <div class="featured-icon-box icon-align-before-content ttm-bgcolor-skincolor pl-35 pt-20 pb-20">
                                    <div class="featured-icon">
                                        <div class="ttm-icon ttm-icon_element-onlytxt ttm-icon_element-size-lg ttm-icon_element-style-square">
                                            <i class="flaticon-scientist"></i>
                                        </div>
                                    </div>
                                    <div class="featured-content">
                                        <div class="featured-desc">
                                            <p>Special Offer</p>
                                        </div>
                                        <div class="featured-title">
                                            <h4 class="mb-0">Get A Free Qoute</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12">
                            <div class="pt-30">
                                <!-- section title -->
                                <div class="section-title">
                                    <div class="title-header">
                                        <h3>PROVIDING CREDENTIALS TO HEALTHCARE PROVIDERS
                                            CAN BE CHALLENGING,<br> BUT WE MAKE THE PROCESS EASIER.</h3>
                                        <h2 class="title">Medical <span class="ttm-textcolor-skincolor">Credentialing</span></h2>
                                    </div>
                                    <div class="title-desc">Medical credentialing is the process of ensuring that healthcare
                                        providers are qualified to provide care. Atlantis RCM works with clients to streamline
                                        medical credentialing processes by reducing paperwork requirements for providers,
                                        allowing them to spend more time caring for patients.</div>
                                </div><!-- section title end -->
                                <div class="featured-icon-box icon-align-before-content icon-ver_align-top">
                                    <div class="featured-icon">
                                        <div class="ttm-icon ttm-icon_element-onlytxt ttm-icon_element-color-skincolor ttm-icon_element-size-md">
                                            <i class="flaticon-lab-1"></i>
                                        </div>
                                    </div>
                                    <div class="featured-content">
                                        <div class="featured-title">
                                            <h3>Our Services Include:</h3>
                                        </div>
                                        <div class="featured-desc">
                                            <p>Outsource your billing and collection to us and reclaim your time for managing revenue.
                                            </p>
                                            <div class="d-flex">
                                                <ul class="ttm-list ttm-list-style-icon style1 ttm-list-icon-color-skincolor pt-15 pr-15">
                                                    <li><i class="fa fa-arrow-circle-right"></i><div class="ttm-list-li-content">Individual Provider
                                                            Enrollment</div></li>
                                                    <li><i class="fa fa-arrow-circle-right"></i><div class="ttm-list-li-content">Group Provider
                                                            Enrollment</div></li>
                                                    <li><i class="fa fa-arrow-circle-right"></i><div class="ttm-list-li-content">Primary Source
                                                            Verification</div></li>
                                                    <li><i class="fa fa-arrow-circle-right"></i><div class="ttm-list-li-content">Recredentialing</div></li>
                                                </ul>
                                                <ul class="ttm-list ttm-list-style-icon style1 ttm-list-icon-color-skincolor pt-15">
                                                    <li><i class="fa fa-arrow-circle-right"></i><div class="ttm-list-li-content">Credentialing
                                                            Appeals</div></li>
                                                    <li><i class="fa fa-arrow-circle-right"></i><div class="ttm-list-li-content">Hospital Privileging /
                                                            Medical Staff credentialing</div></li>
                                                    <li><i class="fa fa-arrow-circle-right"></i><div class="ttm-list-li-content">CAQH Completion
                                                            and Management</div></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- row end -->
                    <div class="row pt-50">
                        <div class="col-lg-6 col-xs-12 pt-30">
                            <div class="title-header">
                                <h4>We offer a wide range of<span class="ttm-textcolor-skincolor"> services to<br> healthcare
                                                        companies</span> including:</h4>
                            </div>
                            <div class="row mt-15 mb-15">
                                <div class="col-sm-6">
                                    <ul class="ttm-list ttm-list-style-icon style1 ttm-list-icon-color-skincolor ttm-textcolor-darkgrey left-side">
                                        <li><i class="fa fa-arrow-circle-right"></i><h6 class="ttm-list-li-content">Solo Practices</h6></li>
                                        <li><i class="fa fa-arrow-circle-right"></i><h6 class="ttm-list-li-content">Group Medical Practices</h6></li>
                                        <li><i class="fa fa-arrow-circle-right"></i><h6 class="ttm-list-li-content">Large Medical Centers</h6></li>
                                        <li><i class="fa fa-arrow-circle-right"></i><h6 class="ttm-list-li-content">Healthcare Facilities</h6></li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="ttm-list ttm-list-style-icon style1 ttm-list-icon-color-skincolor ttm-textcolor-darkgrey">
                                        <li><i class="fa fa-arrow-circle-right"></i><h6 class="ttm-list-li-content">Physical, Speech Therapists</h6></li>
                                        <li><i class="fa fa-arrow-circle-right"></i><h6 class="ttm-list-li-content">Dentists</h6></li>
                                        <li><i class="fa fa-arrow-circle-right"></i><h6 class="ttm-list-li-content">Psychology Counselors</h6></li>
                                        <li><i class="fa fa-arrow-circle-right"></i><h6 class="ttm-list-li-content">DME Companies</h6></li>
                                        <li><i class="fa fa-arrow-circle-right"></i><h6 class="ttm-list-li-content">Home Health Agencies</h6></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-7 m-auto">
                            <!-- ttm_single_image-wrapper -->
                            <div class="ttm_single_image-wrapper position-relative shadow_div">
                                <img class="img-fluid" src="{{asset('/public/assets/front_end/images/home_page/medical-cred_2.jpg')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <!-- row end -->
                </div>
            </section>
            <!--Medical Credentialing end-->
            <!--Medical billing start-->
            <section id="med_billing" class="ttm-row processbox-section ttm-bgcolor-white clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="section-title">
                                <div class="title-header">
                                    <h3>SIMPLIFYING THE BILLING PROCESS FOR FASTER REIMBURSEMENT</h3>
                                    <h2 class="title">Medical Billing <span class="ttm-textcolor-skincolor"> Services</span>
                                    </h2>
                                </div>
                                <div class="title-desc">Instead of establishing billing departments and becoming immersed in medical revenue cycles, medical practices
                                    should focus on treating patients. In this situation, Atlantis RCM steps up to meet your revenue goals and
                                    ensures that your clinical, front office, and outsource billing are in sync.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="align-items-center justify-content-between">
                                <div class="ttm-col-bgcolor-yes ttm-bgcolor-grey ttm-bg ttm-right-span">
                                    <div class="ttm-col-wrapper-bg-layer ttm-bg-layer spacing-15">
                                        <div class="ttm-col-wrapper-bg-layer-inner" style="background-color:rgb(17,102,227);
                                        background: linear-gradient(103deg, rgba(17,102,227,1) 0%, rgba(74,202,204,1) 100%);"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="progressbox-section mt-15 box-shadow4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ttm-processbox-wrapper">
                                    <div class="row no-gutters">
                                        <div class="col-xl-2 col-lg-12 col-md-12 col-sm-12">
                                            <div class="featured-icon-box style9 arrow-1">
                                                <div class="featured-icon">
                                                    <div class="d-flex justify-content-center h-100 align-items-center">
                                                        <img  width="50px" src="{{asset('/public/assets/front_end/images/icons/billing%20steps/Requisition.png')}}" alt="">
                                                    </div>
                                                </div>
                                                <div class="featured-content">
                                                    <p class="top-content">Starting<br> Here</p>
                                                    <div class="ttm-static-box-content">
                                                        <div class="ttm-steps-desc">
                                                            <h3 class="font-weight-800 mb-15"><span class="ttm-static-steps-num ttm-textcolor-skincolor">01-</span>Requisition Scanning</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-lg-12 col-md-12 col-sm-12">
                                            <div class="featured-icon-box style9 arrow-2">
                                                <div class="featured-icon">
                                                    <div class="d-flex justify-content-center h-100 align-items-center">
                                                        <img  width="50px" src="{{asset('/public/assets/front_end/images/icons/billing%20steps/OrderEntry.png')}}" alt="">
                                                    </div>
                                                </div>
                                                <div class="featured-content">
                                                    <div class="ttm-static-box-content">
                                                        <div class="ttm-steps-desc">
                                                            <h3 class="font-weight-800 mb-5"><span class="ttm-static-steps-num ttm-textcolor-skincolor">02-</span> Order Entry</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-lg-12 col-md-12 col-sm-12">
                                            <div class="featured-icon-box style9 arrow-3">
                                                <div class="featured-icon">
                                                    <div class="d-flex justify-content-center h-100 align-items-center">
                                                        <img  width="50px" src="{{asset('/public/assets/front_end/images/icons/billing%20steps/Claim.png')}}" alt="">
                                                    </div>
                                                </div>
                                                <div class="featured-content">
                                                    <div class="ttm-static-box-content">
                                                        <div class="ttm-steps-desc">
                                                            <h3 class="font-weight-800 mb-5"><span class="ttm-static-steps-num ttm-textcolor-skincolor">03-</span> Claims Submission</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-lg-12 col-md-12 col-sm-12">
                                            <div class="featured-icon-box style9 arrow-2">
                                                <div class="featured-icon">
                                                    <div class="d-flex justify-content-center h-100 align-items-center">
                                                        <img  width="50px" src="{{asset('/public/assets/front_end/images/icons/billing%20steps/Returned.png')}}" alt="">
                                                    </div>
                                                </div>
                                                <div class="featured-content">
                                                    <div class="ttm-static-box-content">
                                                        <div class="ttm-steps-desc">
                                                            <h3 class="font-weight-800 mb-5"><span class="ttm-static-steps-num ttm-textcolor-skincolor">04-</span> Returned Remittance</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-lg-12 col-md-12 col-sm-12">
                                            <div class="featured-icon-box style9 arrow-3">
                                                <div class="featured-icon">
                                                    <div class="d-flex justify-content-center h-100 align-items-center">
                                                        <img  width="50px" src="{{asset('/public/assets/front_end/images/icons/billing%20steps/Payments.png')}}" alt="">
                                                    </div>
                                                </div>
                                                <div class="featured-content">
                                                    <div class="ttm-static-box-content">
                                                        <div class="ttm-steps-desc">
                                                            <h3 class="font-weight-800 mb-5"><span class="ttm-static-steps-num ttm-textcolor-skincolor">05-</span> Payments</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-lg-12 col-md-12 col-sm-12">
                                            <div class="featured-icon-box style9 arrow-2">
                                                <div class="featured-icon">
                                                    <div class="d-flex justify-content-center h-100 align-items-center">
                                                        <img  width="50px" src="{{asset('/public/assets/front_end/images/icons/billing%20steps/Posting.png')}}" alt="">
                                                    </div>
                                                </div>
                                                <div class="featured-content">
                                                    <div class="ttm-static-box-content">
                                                        <div class="ttm-steps-desc">
                                                            <h3 class="font-weight-800 mb-5"><span class="ttm-static-steps-num ttm-textcolor-skincolor">06-</span> Posting</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="ttm-row introduction-section clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-xs-12">
                            <div class="pt-15 res-991-pb-40 res-991-pt-0">
                                <!-- section title -->
                                <div class="section-title">
                                    <div class="title-header">
                                        <h3>SIMPLIFYING THE BILLING PROCESS FOR FASTER REIMBURSEMENT</h3>
                                        <h2 class="title">Medical <span class="ttm-textcolor-skincolor"> Billing Services</span></h2>
                                    </div>
                                    <div class="pb-10">
                                        <p>As part of our medical billing services, Atlantis RCM provides</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5 col-md-4 col-sm-6">
                                            <ul class="ttm-list ttm-list-style-icon style2 ttm-textcolor-darkgrey">
                                                <li><i class="fa fa-minus"></i><div class="ttm-list-li-content">Daily claims entry</div></li>
                                                <li><i class="fa fa-minus"></i><div class="ttm-list-li-content">Electronic and paper claim submission</div></li>
                                                <li><i class="fa fa-minus"></i><div class="ttm-list-li-content">Dedicated follow-up</div></li>
                                                <li><i class="fa fa-minus"></i><div class="ttm-list-li-content">Claim correction and/or re-submission</div></li>
                                                <li><i class="fa fa-minus"></i><div class="ttm-list-li-content">Managing collections</div></li>
                                                <li><i class="fa fa-minus"></i><div class="ttm-list-li-content">Patient inquiries</div></li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-7 col-md-8 col-sm-6">
                                            <ul class="ttm-list ttm-list-style-icon style2 ttm-textcolor-darkgrey res-991-pt-10">
                                                <li><i class="fa fa-minus"></i><div class="ttm-list-li-content">Government, commercial and private billing</div></li>
                                                <li><i class="fa fa-minus"></i><div class="ttm-list-li-content">Monthly customized reports</div></li>
                                                <li><i class="fa fa-minus"></i><div class="ttm-list-li-content">Patient statements</div></li>
                                                <li><i class="fa fa-minus"></i><div class="ttm-list-li-content">Payment posting</div></li>
                                                <li><i class="fa fa-minus"></i><div class="ttm-list-li-content">Denial management</div></li>
                                                <li><i class="fa fa-minus"></i><div class="ttm-list-li-content">Tracking / Claims management</div></li>
                                                <li><i class="fa fa-minus"></i><div class="ttm-list-li-content">A/R recovery</div></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mt-25 res-991-mt-30">
                                        <strong>Don’t hesitate to <u><a href="#contact">Contact Us</a></u> for better help.</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-7 m-auto">
                            <!-- ttm_single_image-wrapper -->
                            <div class="ttm_single_image-wrapper">
                                <img class="img-fluid shadow_div" src="{{asset('/public/assets/front_end/images/home_page/med_billing.jpg')}}" alt="">
                            </div>
                        </div>
                    </div><!-- row end -->
                </div>
                <div class="container">
                    <div class="row pt-50">
                        <div class="col-lg-6 col-sm-7 m-auto">
                            <!-- ttm_single_image-wrapper -->
                            <div class="ttm_single_image-wrapper position-relative shadow_div">
                                <img class="img-fluid" src="{{asset('/public/assets/front_end/images/home_page/med_billing-2.jpg')}}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12 pt-30">
                            <div class="title-header">
                                <h4>Among the providers that <span class="ttm-textcolor-skincolor"> utilize our billing services</span> are:</h4>
                            </div>
                            <div class="row mt-15 mb-15">
                                <div class="col-sm-6">
                                    <ul class="ttm-list ttm-list-style-icon style1 ttm-list-icon-color-skincolor ttm-textcolor-darkgrey">
                                        <li><i class="fa fa-arrow-circle-right"></i><h6 class="ttm-list-li-content">Small and Large Practices</h6></li>
                                        <li><i class="fa fa-arrow-circle-right"></i><h6 class="ttm-list-li-content">Behavioral Health Providers</h6></li>
                                        <li><i class="fa fa-arrow-circle-right"></i><h6 class="ttm-list-li-content">Solo Physicians</h6></li>
                                        <li><i class="fa fa-arrow-circle-right"></i><h6 class="ttm-list-li-content">Physician Groups</h6></li>
                                        <li><i class="fa fa-arrow-circle-right"></i><h6 class="ttm-list-li-content">Hospital-owned Physician Practices and Groups</h6></li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="ttm-list ttm-list-style-icon style1 ttm-list-icon-color-skincolor ttm-textcolor-darkgrey">
                                        <li><i class="fa fa-arrow-circle-right"></i><h6 class="ttm-list-li-content">In-home health services providers</h6></li>
                                        <li><i class="fa fa-arrow-circle-right"></i><h6 class="ttm-list-li-content">Urgent Cares</h6></li>
                                        <li><i class="fa fa-arrow-circle-right"></i><h6 class="ttm-list-li-content">DME companies</h6></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- row end -->
                </div>
            </section>
            <!--Medical billing end-->
            <!--Contact Us Start-->
            <section id="contact" class="ttm-row cta-info-section ttm-bgcolor-grey bg-layer mt-100 clearfix">
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <div class="col-lg-4 col-md-8 col-sm-8">
                            <div class="ttm-col-bgcolor-yes ttm-bg ttm-bgcolor-skincolor z-index-2 spacing-5">
                                <div class="ttm-col-wrapper-bg-layer ttm-bg-layer shadow_div"></div>
                                <div class="layer-content">
                                    <div class="pb-15">
                                        <h3>Connect With Us</h3>
                                        <p>Get in touch with us to learn more about our experience, and the value we can provide.</p>
                                    </div>
                                    <!--featured-icon-box-->
                                    <div class="featured-icon-box icon-align-before-content icon-ver_align-top">
                                        <div class="featured-icon">
                                            <div class="ttm-icon ttm-icon_element-onlytxt ttm-icon_element-color-white ttm-icon_element-size-sm">
                                                <i class="flaticon-placeholder"></i>
                                            </div>
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-desc">
                                                <p>447 Broadway, 2nd Floor Suite #507, New York, 10013</p>
                                            </div>
                                        </div>
                                    </div><!-- featured-icon-box end-->
                                    <div class="sep_holder_box width-100 mt-20 mb-20">
                                        <span class="sep_holder"><span class="sep_line"></span></span>
                                    </div>
                                    <!--featured-icon-box-->
                                    <div class="featured-icon-box icon-align-before-content icon-ver_align-top">
                                        <div class="featured-icon">
                                            <div class="ttm-icon ttm-icon_element-onlytxt ttm-icon_element-color-white ttm-icon_element-size-sm">
                                                <i class="flaticon-call"></i>
                                            </div>
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-desc">
                                                <p><a href="tel:+15187301875">+1 518 730 1875</a></p>
                                            </div>
                                        </div>
                                    </div><!-- featured-icon-box end-->
                                    <div class="sep_holder_box width-100 mt-20 mb-20">
                                        <span class="sep_holder"><span class="sep_line"></span></span>
                                    </div>
                                    <!--featured-icon-box-->
                                    <div class="featured-icon-box icon-align-before-content icon-ver_align-top">
                                        <div class="featured-icon">
                                            <div class="ttm-icon ttm-icon_element-onlytxt ttm-icon_element-color-white ttm-icon_element-size-sm">
                                                <i class="ti ti-email"></i>
                                            </div>
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-desc">
                                                <a href="mailto:info@atlantisrcm.com">info@Atlantisrcm.com</a>
                                            </div>
                                        </div>
                                    </div><!-- featured-icon-box end-->
                                    <ul class="social-icons circle social-hover mt-30">
                                        <li class="social-facebook"><a class="tooltip-top" target="_blank" href="https://www.facebook.com/Atlantis-RCM-111413964964199" data-tooltip="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li class="social-twitter"><a class="tooltip-top" target="_blank" href="https://twitter.com/AtlantisRcm" data-tooltip="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li class="social-linkedin"><a class=" tooltip-top" target="_blank" href="https://www.linkedin.com/company/atlantis-rcm" data-tooltip="LinkedIn"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="ttm-col-bgcolor-yes ttm-bg ttm-bgcolor-grey z-index-1">
                                <div class="ttm-col-wrapper-bg-layer ttm-bg-layer"></div>
                                <div class="layer-content">
                                    <!-- testimonial-box -->
                                    <div class="pt-45 pl-50 pb-50 pr-50 res-991-pl-15 res-991-pr-15 res-991-pt-30">
                                        <!-- section-title -->
                                        <div class="section-title">
                                            <div class="title-header">
                                                <h3>Contact Us</h3>
                                                <h2 class="title">Feel Free To <span class="ttm-textcolor-skincolor">Ask.</span></h2>
                                            </div>
                                        </div><!-- section-title end -->
                                        <form id="ttm-contactform-2" class="ttm-contactform-2 wrap-form clearfix" method="post" action="javascript:contact_us_action_form();">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-12 pb-3">
                                                    <label>
                                                        What are you looking for?
                                                    </label>
                                                    <div class="form-check">
                                                        <input class="form-check-input form-type" type="radio" name="contact_for" value="Credentialing/Contracting Services" id="contact_for1" required>
                                                        <label class="form-check-label" for="contact_for1">
                                                            Credentialing/Contracting Services
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input form-type" type="radio" value="Medical Billing Services" name="contact_for" id="contact_for2" required>
                                                        <label class="form-check-label" for="contact_for2">
                                                            Medical Billing Services
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label>
                                                        <span class="text-input"><input name="specialty" type="text" value="" placeholder="What is your specialty?" required="required"></span>
                                                    </label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>
                                                        <span class="text-input"><input name="name" type="text" value="" placeholder="Your Name" required="required"></span>
                                                    </label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>
                                                        <span class="text-input"><input name="email" type="email" value="" placeholder="Your Email" required="required"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>
                                                        <span class="text-input"><input name="phone" type="text" value="" placeholder="Phone Number" required="required"></span>
                                                    </label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>
                                                        <span class="text-input"><input name="subject" type="text" value="" placeholder="Subject" required="required"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <label>
                                                <span class="text-input"><textarea name="message" rows="3" placeholder="Message" required="required"></textarea></span>
                                            </label>
                                            <div class="mb-3 row">
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input form-type" type="checkbox" name="opt_in_out" value="1" id="opt_in_out">
                                                        <label class="form-check-label" for="opt_in_out">
                                                            I accept to receive communication via sms, email and / or phone related to Medical Billing from Atlantis RCM
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="msg_response" style="display: none"><strong></strong></div>
                                            <button class="submit ttm-btn ttm-btn-size-md ttm-btn-shape-round ttm-btn-style-fill ttm-btn-color-skincolor" type="submit">Send Message</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--Contact Us end-->
            <footer class="footer widget-footer clearfix">
                <div class="second-footer ttm-bgimage-yes bg-footer ttm-bg ttm-bgcolor-darkgrey">
                    <div class="ttm-row-wrapper-bg-layer ttm-bg-layer"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 widget-area">
                                <div class="widget widget-widget_contact clearfix">
                                    <h3 class="widget-title">Contact Us</h3>
                                    <ul class="widget_contact_wrapper">
                                        <li><i class="fa fa-map-marker"></i><p>447 Broadway, 2nd Floor Suite #507, New York, 10013</p></li>
                                        <li><i class="fa fa-phone"></i><h3 class="mb-0">Phone</h3><p><a href="tel:+15187301875">+1 518 730 1875</a></p></li>
                                        <li><i class="fa fa-envelope-o"></i><h3 class="mb-0">Email</h3><a href="mailto:info@atlantisrcm.com">info@atlantisrcm.com</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 widget-area">
                                <div class="widget widget_text text-center clearfix">
                                    <div class="footer-logo margin_bottom15">
                                        <img width="175" height="115" id="logo-img-1" class="img-center standardlogo" src="{{asset('/public/assets/front_end/images/AtlantisLogo_White.svg')}}" alt="logo-img">
                                    </div>
                                    <div class="textwidget widget-text ">
                                        <p>Our consultative approach allows you to get the solutions you need to succeed.</p>
                                    </div>
                                    <div class="social-icons circle mt-30">
                                        <ul class="list-inline">
                                            <li class="social-facebook"><a class="tooltip-top" target="_blank" href="https://www.facebook.com/Atlantis-RCM-111413964964199" data-tooltip="Facebook" rel="noopener" aria-label="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                            <li class="social-linkedin"><a class="tooltip-top" target="_blank" href="https://www.linkedin.com/company/atlantis-rcm" data-tooltip="LinkedIn" rel="noopener" aria-label="linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                            <li class="social-twitter"><a class="tooltip-top" target="_blank" href="https://twitter.com/AtlantisRcm" data-tooltip="Twitter" rel="noopener" aria-label="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 widget-area">
                                <div class="widget widget_nav_menu menu-footer-services-menu pl-35 res-991-pl-0 clearfix">
                                    <h3 class="widget-title">Quick Links</h3>
                                    <ul id="menu-footer-services-menu" class="menu">
                                        <li><a href="{{route('/')}}">Atlantis RCM</a></li>
                                        <li><a href="#med_credetial">Medical Credentialing</a></li>
                                        <li><a href="#med_billing">Medical Billing</a></li>
                                        <li><a href="#about">About Us</a></li>
                                        <li><a href="#contact">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row copyright">
                    <div class="col-md-12">
                        <div class="text-center ttm-textcolor-white">
                            <span>Copyright © 2022 <a href="{{route('/')}}">Atlantis RCM</a>. All Rights Reserved</span>
                        </div>
                    </div>
                </div>
            </footer>
            <!--back-to-top start-->
            <a id="totop" href="#top">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
@endsection
@section('footer-scripts')
    <script>
        function contact_us_action_form(){
            let data = new FormData($('#ttm-contactform-2')[0]);
            let a = function () {
                // $('#ttm-contactform-2')[0].reset();
            };
            let arr = [a];
            call_ajax_with_functions('', '{{route('contact_us_form_save')}}', data, arr);
        }
    </script>
@endsection
