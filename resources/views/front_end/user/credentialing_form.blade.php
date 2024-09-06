@extends('front_end.layout.main')
@section('content')
    <!--header start-->
    <header id="masthead" class="header ttm-header-style-03">
        <!-- site-header-menu -->
        <div id="site-header-menu" class="site-header-menu">
            <div class="site-header-menu-inner ttm-stickable-header" style="background-color: #00263e;">
                <div class="container">
                    <div class="d-xl-flex flex-xl-row align-items-xl-center justify-content-xl-between">
                        <!-- site-branding -->
                        <div class="site-branding d-flex">
                            <a class="home-link" href="{{ url('/') }}" title="Atlantis_rcm" rel="home">
                                <img id="logo-img" class="img-fluid auto_size logo-img desktop_logo" height="160"
                                     width="110"
                                     src="{{asset('/public/assets/front_end/images/AtlantisLogo_White.svg')}}"
                                     alt="logo-img">
                                <img id="logo-img" class="img-fluid auto_size logo-img tab_mobile_logo" height="160"
                                     width="110" src="{{asset('/public/assets/front_end/images/RCM-Logo.svg')}}"
                                     alt="logo-img">
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
                                    </div>
                                    447 Broadway, 2nd Floor Suite #507, New York, 10013
                                </div>
                                <div class="top_bar_contact_item ">
                                    <div class="top_bar_icon"><i class="fa fa-envelope-o light-blue-color"></i></div>
                                    <a class="text-light" href="mailto:info@atlantisrcm.com">info@atlantisrcm.com</a>
                                </div>
                                <div class="top_bar_contact_item text-light">
                                    <div class="top_bar_icon"><i class="fa fa-clock-o light-blue-color"></i></div>
                                    Office Hour: 08:00am - 6:00pm (EST)
                                </div>
                                <div class="top_bar_contact_item top_bar_social">
                                    <ul class="social-icons">
                                        <li class="facebook-icon"><a
                                                href="https://www.facebook.com/Atlantis-RCM-111413964964199"
                                                rel="noopener" aria-label="facebook"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li class="twitter-icon"><a href="https://twitter.com/AtlantisRcm"
                                                                    rel="noopener" aria-label="twitter"><i
                                                    class="fa fa-twitter"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center justify-content-end">
                                <!-- menu -->
                                <nav class="main-menu menu-mobile d-xl-flex align-items-center justify-content-start"
                                     id="menu">
                                    <ul class="menu">
                                        <li class="mega-menu-item">
                                            {{--                                            <a href="{{ route('/') }}" class="mega-menu-link">Home</a>--}}
                                            <a href="https://atlantisrcm.com" class="mega-menu-link">Home</a>
                                        </li>
                                        <li class="mega-menu-item">
                                            <a href="javascript:;" class="mega-menu-link">About</a>
                                            <ul class="mega-submenu">
                                                {{--                                                <li><a href="{{ route('/', ['section'=>'abt_atlantis_rcm','scroll'=>50]) }}">About Atlantis RCM</a></li>--}}
                                                {{--                                                <li><a href="{{ route('/', ['section'=>'abt_rcm','scroll'=>50]) }}">About RCM</a></li>--}}
                                                <li><a href="https://atlantisrcm.com/#abt_atlantis_rcm">About Atlantis
                                                        RCM</a></li>
                                                <li><a href="https://atlantisrcm.com/#abt_rcm">About RCM</a>
                                            </ul>
                                        </li>
                                        <li class="mega-menu-item">
                                            {{--                                            <a href="{{ route('/', ['section'=>'med_credetial','scroll'=>50]) }}" class="mega-menu-link">Medical Credentialing</a>--}}
                                            <a href="https://atlantisrcm.com/#med_credetial" class="mega-menu-link">Medical
                                                Credentialing</a>
                                        </li>
                                        <li class="mega-menu-item">
                                            {{--                                            <a href="{{ route('/', ['section'=>'med_billing','scroll'=>50]) }}" class="mega-menu-link">Medical Billing</a>--}}
                                            <a href="https://atlantisrcm.com/#med_billing" class="mega-menu-link">Medical
                                                Billing</a>
                                        </li>
                                        <li class="mega-menu-item">
                                            {{--                                            <a href="{{ route('/', ['section'=>'contact','scroll'=>200]) }}" class="mega-menu-link">Contact Us</a>--}}
                                            <a href="https://atlantisrcm.com/#contact" class="mega-menu-link">Contact
                                                Us</a>
                                        </li>
                                        <li class="mega-menu-item">
                                        @if(Auth::user())
                                            <li class="mega-menu-item">
                                                <a href="javascript:;" class="mega-menu-link"><i
                                                        class="fa fa-user-circle"></i> {{Auth::user()->full_name}}
                                                </a>
                                                <ul class="mega-submenu">
                                                    <li><a href="{{ route('user_form') }}">Credentialing Form</a></li>
                                                    <li><a href="{{ route('logout') }}"
                                                           class="mega-menu-link">Logout</a></li>
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
    <div class="page mt-100">
        <div class="site-main">
            <!--Credentialing form Start-->
            <section class="ttm-row cta-info-section ttm-bgcolor-grey bg-layer clearfix">
                <div class="container"><br>
                    <!--nav tabs stary-->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link nav-btn-cl" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                    type="button" role="tab" aria-controls="profile" aria-selected="true">User Profile
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link nav-btn-cl active" id="credentialing-tab" data-bs-toggle="tab" data-bs-target="#credentialing"
                                    type="button" role="tab" aria-controls="credentialing" aria-selected="true">Credentialing
                                Form
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link nav-btn-cl" id="billing-tab" data-bs-toggle="tab" data-bs-target="#billing"
                                    type="button" role="tab" aria-controls="billing" aria-selected="false">Billing Form
                            </button>
                        </li>
                    </ul>
                    <!-- nav tab stop-->
                    <!-- row -->
                    <div class="row">
                        <div class="tab-content" id="myTabContent">
                            @include('front_end.user.profile_form')
                            <div class="tab-pane fade show active" id="credentialing" role="tabpanel" aria-labelledby="credentialing-tab">
                                <div class="col">
                                    <div class="ttm-col-bgcolor-yes ttm-bg ttm-bgcolor-grey z-index-1">
                                        <div class="ttm-col-wrapper-bg-layer ttm-bg-layer"></div>
                                        <div class="layer-content">
                                            <!-- testimonial-box -->
                                            <div class="pt-45 pl-50 pb-50 pr-50 res-991-pl-15 res-991-pr-15 res-991-pt-30">
                                                <!-- section-title -->
                                                <div class="section-title">
                                                    <div class="title-header">
                                                        <h3>User Info</h3>
                                                        <h2 class="title"> Credentialing <span
                                                                class="ttm-textcolor-skincolor">Form.</span></h2>
                                                    </div>
                                                </div><!-- section-title end -->
                                                <form id="credentialing_form"
                                                      class="ttm-contactform-2 wrap-form clearfix"
                                                      action="javascript:form_submit();">
                                                    @csrf
                                                    <input type="hidden" name="credential_id"
                                                           value="{{$credential?$credential->credential_id:''}}">
                                                    <div class="row">
                                                        <div class="col-lg-12 pb-3">
                                                            <label>
                                                                What are you looking for?
                                                            </label>
                                                            <div class="form-check">
                                                                <input class="form-check-input form-type" type="radio"
                                                                       name="form_type" value="credentialing_agencies"
                                                                       id="form_type1"
                                                                       {{$credential?($credential->form_type=='credentialing_agencies'? 'checked':''):''}} required>
                                                                <label class="form-check-label" for="form_type1">
                                                                    Credentialing/Contracting Services For Group
                                                                    Agencies
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input form-type" type="radio"
                                                                       value="credentialing_individual_provider"
                                                                       name="form_type" id="form_type2"
                                                                       {{$credential?($credential->form_type=='credentialing_individual_provider'? 'checked':''):''}} required>
                                                                <label class="form-check-label" for="form_type2">
                                                                    Credentialing/Contracting Services For Individual
                                                                    Providers
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="credentialing_form_id" class="d-none">
                                                        <div class="row">
                                                            <div class="col-lg-6 mb-3">
                                                                <label>Group Name </label>
                                                                <input name="group_name" type="text" value="{{$credential?$credential->group_name:''}}" required>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label>Group NPI</label>
                                                                <input name="group_npi" type="number" value="{{$credential?$credential->group_npi:''}}" required>
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label>Legal Name on IRS letter</label>
                                                                <input name="legal_name" type="text" value="{{$credential?$credential->legal_name:''}}">
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label>EIN/TIN</label>
                                                                <input name="ein_tin" type="text" value="{{$credential?$credential->ein_tin:''}}">
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label>DOB</label>
                                                                <input name="owner_dob" type="date" value="{{$credential?$credential->owner_dob:''}}">
                                                            </div>
                                                            <div class="col-lg-6 mb-3 provider-field">
                                                                <label>Provider Name</label>
                                                                <input name="provider_name" type="text"value="{{$credential?$credential->provider_name:''}}">
                                                            </div>
                                                            <div class="col-lg-6 mb-3 provider-field">
                                                                <label>Provider NPI</label>
                                                                <input name="provider_npi" type="number" value="{{$credential?$credential->provider_npi:''}}">
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label>Social Security Number (SSN)</label>
                                                                <input name="ssn_number" type="text" value="{{$credential?$credential->ssn_number:''}}">
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label>Service Address</label>
                                                                <input name="service_address" type="text" value="{{$credential?$credential->service_address:''}}">
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label>Billing/Mailing Address</label>
                                                                <input name="billing_mailing_address" type="text" value="{{$credential?$credential->billing_mailing_address:''}}">
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label>MEDICARE GROUP PTAN</label>
                                                                <input name="medicare_group_ptan" type="text" value="{{$credential?$credential->medicare_group_ptan:''}}">
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label>MEDICARE INDIVIDUAL PTAN</label>
                                                                <input name="medicare_individual_ptan" type="text" value="{{$credential?$credential->medicare_individual_ptan:''}}">
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label>MEDICARE ID</label>
                                                                <input  type="text" name="medicare_id" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"  value="{{$credential?$credential->medicare_id:''}}">
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label>Start date</label>
                                                                <input name="start_date" type="date"
                                                                       value="{{$credential?$credential->start_date:''}}"
                                                                       placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="provider-field">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <h6>CAQH Logins</h6>
                                                                </div>
                                                                <br>
                                                                <div class="col-lg-6">
                                                                    <label>
                                                                        <span class="text-input"><input
                                                                                name="caqh_username" type="text"
                                                                                value="{{$credential?$credential->caqh_username:''}}"
                                                                                placeholder="username"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label>
                                                                        <span class="text-input"><input
                                                                                name="caqh_password" type="text"
                                                                                value="{{$credential?$credential->caqh_password:''}}"
                                                                                placeholder="password"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <h6>NPPES/PECOS Logins </h6>
                                                            </div>
                                                            <br>
                                                            <div class="col-lg-6">
                                                                <label>
                                                                    <span class="text-input"><input
                                                                            name="nppes_username" type="text"
                                                                            value="{{$credential?$credential->nppes_username:''}}"
                                                                            placeholder="username"></span>
                                                                </label>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>
                                                                    <span class="text-input"><input
                                                                            name="nppes_password" type="text"
                                                                            value="{{$credential?$credential->nppes_password:''}}"
                                                                            placeholder="password"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="provider-field">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <h6>Provider Source Logins (If WA state) </h6>
                                                                </div>
                                                                <br>
                                                                <div class="col-lg-6">
                                                                    <label>
                                                                        <span class="text-input"><input
                                                                                name="provider_source_username"
                                                                                type="text"
                                                                                value="{{$credential?$credential->provider_source_username:''}}"
                                                                                placeholder="username"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label>
                                                                        <span class="text-input"><input
                                                                                name="provider_source_password"
                                                                                type="text"
                                                                                value="{{$credential?$credential->provider_source_password:''}}"
                                                                                placeholder="password"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="provider-field">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <h6>Avality Logins </h6>
                                                                </div>
                                                                <br>
                                                                <div class="col-lg-4">
                                                                    <select name="availity_state" id="avality_sate">
                                                                        <option value="">Select State</option>
                                                                        <option value="California" {{$credential?($credential->availity_state=='California'? 'selected':''):''}}>
                                                                            California
                                                                        </option>
                                                                        <option value="Colorado" {{$credential?($credential->availity_state=='Colorado'? 'selected':''):''}}>
                                                                            Colorado
                                                                        </option>
                                                                        <option value="Connecticut" {{$credential?($credential->availity_state=='Connecticut'? 'selected':''):''}}>
                                                                            Connecticut
                                                                        </option>
                                                                        <option value="Georgia" {{$credential?($credential->availity_state=='Georgia'? 'selected':''):''}}>
                                                                            Georgia
                                                                        </option>
                                                                        <option value="Indiana" {{$credential?($credential->availity_state=='Indiana'? 'selected':''):''}}>
                                                                            Indiana
                                                                        </option>
                                                                        <option value="Kentucky" {{$credential?($credential->availity_state=='Kentucky'? 'selected':''):''}}>
                                                                            Kentucky
                                                                        </option>
                                                                        <option value="Maine" {{$credential?($credential->availity_state=='Maine'? 'selected':''):''}}>
                                                                            Maine
                                                                        </option>
                                                                        <option value="Missouri" {{$credential?($credential->availity_state=='Missouri'? 'selected':''):''}}>
                                                                            Missouri
                                                                        </option>
                                                                        <option value="Nevada" {{$credential?($credential->availity_state=='Nevada'? 'selected':''):''}}>
                                                                            Nevada
                                                                        </option>
                                                                        <option value="New Hampshire" {{$credential?($credential->availity_state=='New Hampshire'? 'selected':''):''}}>
                                                                            New Hampshire
                                                                        </option>
                                                                        <option value="New York" {{$credential?($credential->availity_state=='New York'? 'selected':''):''}}>
                                                                            New York
                                                                        </option>
                                                                        <option value="Ohio" {{$credential?($credential->availity_state=='Ohio'? 'selected':''):''}}>
                                                                            Ohio
                                                                        </option>
                                                                        <option value="Virginia" {{$credential?($credential->availity_state=='Virginia'? 'selected':''):''}}>
                                                                            Virginia
                                                                        </option>
                                                                        <option value="Wisconsin" {{$credential?($credential->availity_state=='Wisconsin'? 'selected':''):''}}>
                                                                            Wisconsin
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <label>
                                                                        <span class="text-input"><input
                                                                                name="availity_username" type="text"
                                                                                value="{{$credential?$credential->availity_username:''}}"
                                                                                placeholder="username"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <label>
                                                                        <span class="text-input"><input
                                                                                name="availity_password" type="text"
                                                                                value="{{$credential?$credential->availity_password:''}}"
                                                                                placeholder="password"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="state_license" name="state_license"
                                                                           value="1"
                                                                           {{$credential?($credential->state_license=='1'? 'checked':''):''}} onclick="state_imgfield()">
                                                                    <label class="form-check-label" for="state_license">
                                                                        State License(s)
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>
                                                                    <span class="text-input"><input class="img_field"
                                                                                                    id="state_image"
                                                                                                    name="state_license_image[]"
                                                                                                    type="file" multiple
                                                                                                    value=""
                                                                                                    placeholder=""></span>
                                                                </label>
                                                            </div>
                                                            <div class="col-12">
                                                                @if(user_doc_status(Auth::user()->user_id, 'state_license') != null)
                                                                    @if(user_doc_status(Auth::user()->user_id, 'state_license')->status ==2)
                                                                        <span class="badge badge-warning">
                                                                            Rejected:
                                                                            {{ user_doc_status(Auth::user()->user_id, 'state_license')->reject_message }}
                                                                        </span>
                                                                    @elseif(user_doc_status(Auth::user()->user_id, 'state_license')->status ==1)
                                                                        <span class="badge badge-success">
                                                                            Approved
                                                                        </span>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-12 my-3">
                                                                @php $stateimg_cnt=0; @endphp
                                                                @if($credential && $credential->state_license_image !=null)
                                                                    @foreach(explode(',',$credential->state_license_image)  as $img_index => $image)
                                                                        <div class="btn_pos"
                                                                             id="old_state_license_img{{$img_index}}">
                                                                            <a class="btn btn-sm btn-outline-success m-1"
                                                                               download
                                                                               href="{{asset('public/credential_images/'.$image)}}">
                                                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                                                File<span class=""></span></a>
                                                                            <i class="fa fa-times-circle"
                                                                               onclick="remove_state_license_image({{$img_index}})"
                                                                               title="Remove File"></i>
                                                                        </div>
                                                                        <input type="hidden"
                                                                               name="old_state_license_image[{{$img_index}}]"
                                                                               value="{{$image}}"
                                                                               id="old_state_license_image_{{$img_index}}"
                                                                               class="">
                                                                        @php $stateimg_cnt ++; @endphp
                                                                    @endforeach
                                                                @endif
                                                                <input type="hidden" name="stateimg_name"
                                                                       id="stateimg_cnt"
                                                                       value="<?php echo $stateimg_cnt;?>">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="accreditation" name="accreditation"
                                                                           value="1"
                                                                           {{$credential?($credential->accreditation=='1'? 'checked':''):''}} onclick="accreditation_imgfield()">
                                                                    <label class="form-check-label" for="accreditation">
                                                                        Accreditation(s)
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>
                                                                    <span class="text-input"><input class="img_field"
                                                                                                    id="accreditation_image"
                                                                                                    name="accreditation_image[]"
                                                                                                    type="file" multiple
                                                                                                    value=""
                                                                                                    placeholder=""></span>
                                                                </label>
                                                            </div>
                                                            <div class="col-12">
                                                                @if(user_doc_status(Auth::user()->user_id, 'accredation') != null)
                                                                    @if(user_doc_status(Auth::user()->user_id, 'accredation')->status ==2)
                                                                        <span class="badge badge-warning">
                                                                            Rejected:
                                                                            {{ user_doc_status(Auth::user()->user_id, 'accredation')->reject_message }}
                                                                        </span>
                                                                    @elseif(user_doc_status(Auth::user()->user_id, 'accredation')->status ==1)
                                                                        <span class="badge badge-success">
                                                                            Approved
                                                                        </span>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-12 my-3">
                                                                @php $credentialimg_cnt =0; @endphp
                                                                @if($credential && $credential->accreditation_image !=null)
                                                                    @foreach(explode(',',$credential->accreditation_image)  as $img_index => $image)
                                                                        <div class="btn_pos"
                                                                             id="old_accreditation_img{{$img_index}}">
                                                                            <a class="btn btn-sm btn-outline-success m-1"
                                                                               download
                                                                               href="{{asset('public/credential_images/'.$image)}}">
                                                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                                                File<span class=""></span></a>
                                                                            <i class="fa fa-times-circle"
                                                                               onclick="remove_accreditation_image({{$img_index}})"
                                                                               title="Remove File"></i>
                                                                        </div>
                                                                        <input type="hidden"
                                                                               name="old_accreditation_image[{{$img_index}}]"
                                                                               value="{{$image}}"
                                                                               id="old_accreditation_image_{{$img_index}}"
                                                                               class="">
                                                                        @php $credentialimg_cnt ++; @endphp
                                                                    @endforeach
                                                                @endif
                                                                <input type="hidden" name="credentialimg_cnt"
                                                                       id="credentialimg_cnt"
                                                                       value="<?php echo $credentialimg_cnt;?>">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="irs_letter" name="irs_letter" value="1"
                                                                           {{$credential?($credential->irs_letter=='1'? 'checked':''):''}} onclick="irs_imgfield(this)">
                                                                    <label class="form-check-label" for="irs_letter">
                                                                        IRS Letter
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>
                                                                    <span class="text-input"><input class="img_field"
                                                                                                    id="irs_letter_image"
                                                                                                    name="irs_letter_image[]"
                                                                                                    type="file" multiple
                                                                                                    value=""
                                                                                                    placeholder=""></span>
                                                                </label>
                                                            </div>
                                                            <div class="col-12">
                                                                @if(user_doc_status(Auth::user()->user_id, 'irs_letter') != null)
                                                                    @if(user_doc_status(Auth::user()->user_id, 'irs_letter')->status ==2)
                                                                        <span class="badge badge-warning">
                                                                            Rejected:
                                                                            {{ user_doc_status(Auth::user()->user_id, 'irs_letter')->reject_message }}
                                                                        </span>
                                                                    @elseif(user_doc_status(Auth::user()->user_id, 'irs_letter')->status ==1)
                                                                        <span class="badge badge-success">
                                                                            Approved
                                                                        </span>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-12 my-3">
                                                                @php $irsimg_cnt=0; @endphp
                                                                @if($credential && $credential->irs_letter_image !=null)
                                                                    @foreach(explode(',',$credential->irs_letter_image)  as $img_index => $image)
                                                                        <div class="btn_pos"
                                                                             id="old_irs_letter_img{{$img_index}}">
                                                                            <a class="btn btn-sm btn-outline-success m-1"
                                                                               download
                                                                               href="{{asset('public/credential_images/'.$image)}}">
                                                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                                                File<span class=""></span></a>
                                                                            <i class="fa fa-times-circle"
                                                                               onclick="remove_irs_letter_image({{$img_index}})"
                                                                               title="Remove File"></i>
                                                                        </div>
                                                                        <input type="hidden"
                                                                               name="old_irs_letter_image[{{$img_index}}]"
                                                                               value="{{$image}}"
                                                                               id="old_irs_letter_image_{{$img_index}}"
                                                                               class="">
                                                                        @php $irsimg_cnt ++; @endphp
                                                                    @endforeach
                                                                @endif
                                                                <input type="hidden" name="irsimg_cnt" id="irsimg_cnt"
                                                                       value="<?php echo $irsimg_cnt;?>">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="bank_letter" name="bank_letter" value="1"
                                                                           {{$credential?($credential->bank_letter=='1'? 'checked':''):''}} onclick="bancklettter_imgfield()">
                                                                    <label class="form-check-label" for="bank_letter">
                                                                        Bank Letter/Voided Check
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>
                                                                    <span class="text-input"><input class="img_field"
                                                                                                    id="banck_letter_image"
                                                                                                    name="bank_letter_image[]"
                                                                                                    type="file" multiple
                                                                                                    value=""
                                                                                                    placeholder=""></span>
                                                                </label>
                                                            </div>
                                                            <div class="col-12">
                                                                @if(user_doc_status(Auth::user()->user_id, 'bank_letter') != null)
                                                                    @if(user_doc_status(Auth::user()->user_id, 'bank_letter')->status ==2)
                                                                        <span class="badge badge-warning">
                                                                            Rejected:
                                                                            {{ user_doc_status(Auth::user()->user_id, 'bank_letter')->reject_message }}
                                                                        </span>
                                                                    @elseif(user_doc_status(Auth::user()->user_id, 'bank_letter')->status ==1)
                                                                        <span class="badge badge-success">
                                                                            Approved
                                                                        </span>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-12 my-3">
                                                                @php $bankimg_cnt =0; @endphp
                                                                @if($credential && $credential->bank_letter_image !=null)
                                                                    @foreach(explode(',',$credential->bank_letter_image)  as $img_index => $image)
                                                                        <div class="btn_pos"
                                                                             id="old_bank_letter_img{{$img_index}}">
                                                                            <a class="btn btn-sm btn-outline-success m-1"
                                                                               download
                                                                               href="{{asset('public/credential_images/'.$image)}}">
                                                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                                                File<span class=""></span></a>
                                                                            <i class="fa fa-times-circle"
                                                                               onclick="remove_bank_letter_image({{$img_index}})"
                                                                               title="Remove File"></i>
                                                                        </div>
                                                                        <input type="hidden"
                                                                               name="old_bank_letter_image[{{$img_index}}]"
                                                                               value="{{$image}}"
                                                                               id="old_bank_letter_image_{{$img_index}}"
                                                                               class="">
                                                                        @php $bankimg_cnt ++; @endphp
                                                                    @endforeach
                                                                @endif
                                                                <input type="hidden" name="bankimg_cnt" id="bankimg_cnt"
                                                                       value="<?php echo $bankimg_cnt;?>">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="professional_liability_insurance"
                                                                           name="professional_liability_insurance"
                                                                           value="1" value="1"
                                                                           {{$credential?($credential->professional_liability_insurance=='1'? 'checked':''):''}} onclick="professional_imgfield()">
                                                                    <label class="form-check-label"
                                                                           for="professional_liability_insurance">
                                                                        Professional Liability Insurance
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>
                                                                    <span class="text-input"><input class="img_field"
                                                                                                    id="professional_image"
                                                                                                    name="professional_liability_insurance_image[]"
                                                                                                    type="file" multiple
                                                                                                    value=""
                                                                                                    placeholder=""></span>
                                                                </label>
                                                            </div>
                                                            <div class="col-12">
                                                                @if(user_doc_status(Auth::user()->user_id, 'professional_liability_insurance') != null)
                                                                    @if(user_doc_status(Auth::user()->user_id, 'professional_liability_insurance')->status ==2)
                                                                        <span class="badge badge-warning">
                                                                            Rejected:
                                                                            {{ user_doc_status(Auth::user()->user_id, 'professional_liability_insurance')->reject_message }}
                                                                        </span>
                                                                    @elseif(user_doc_status(Auth::user()->user_id, 'professional_liability_insurance')->status ==1)
                                                                        <span class="badge badge-success">
                                                                            Approved
                                                                        </span>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-12 my-3">
                                                                @php $professionalimg_cnt =0; @endphp
                                                                @if($credential && $credential->professional_liability_insurance_image !=null)
                                                                    @foreach(explode(',',$credential->professional_liability_insurance_image)  as $img_index => $image)
                                                                        <div class="btn_pos"
                                                                             id="old_professional_liability_insurance_img{{$img_index}}">
                                                                            <a class="btn btn-sm btn-outline-success m-1"
                                                                               download
                                                                               href="{{asset('public/credential_images/'.$image)}}">
                                                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                                                File<span class=""></span></a>
                                                                            <i class="fa fa-times-circle"
                                                                               onclick="remove_professional_liability_insurance_image({{$img_index}})"
                                                                               title="Remove File"></i>
                                                                        </div>
                                                                        <input type="hidden"
                                                                               name="old_professional_liability_insurance_image[{{$img_index}}]"
                                                                               value="{{$image}}"
                                                                               id="old_professional_liability_insurance_image_{{$img_index}}"
                                                                               class="">
                                                                        @php $professionalimg_cnt ++; @endphp
                                                                    @endforeach
                                                                @endif
                                                                <input type="hidden" name="professionalimg_cnt"
                                                                       id="professionalimg_cnt"
                                                                       value="<?php echo $professionalimg_cnt;?>">
                                                            </div>
                                                            <div class="col-lg-6 provider-field">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="driver_license" name="driver_license"
                                                                           value="1"
                                                                           {{$credential?($credential->driver_license=='1'? 'checked':''):''}} onclick="drivers_imgfield()">
                                                                    <label class="form-check-label"
                                                                           for="driver_license">
                                                                        Drivers License
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 provider-field">
                                                                <label>
                                                                    <span class="text-input"><input class="img_field"
                                                                                                    id="drivers_image"
                                                                                                    name="driver_license_image[]"
                                                                                                    type="file" multiple
                                                                                                    value=""
                                                                                                    placeholder=""></span>
                                                                </label>
                                                            </div>
                                                            <div class="col-12">
                                                                @if(user_doc_status(Auth::user()->user_id, 'driver_license') != null)
                                                                    @if(user_doc_status(Auth::user()->user_id, 'driver_license')->status ==2)
                                                                        <span class="badge badge-warning">
                                                                            Rejected:
                                                                            {{ user_doc_status(Auth::user()->user_id, 'driver_license')->reject_message }}
                                                                        </span>
                                                                    @elseif(user_doc_status(Auth::user()->user_id, 'driver_license')->status ==1)
                                                                        <span class="badge badge-success">
                                                                            Approved
                                                                        </span>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-12 my-3">
                                                                @php $driverimg_cnt =0; @endphp
                                                                @if($credential && $credential->driver_license_image !=null)
                                                                    @foreach(explode(',',$credential->driver_license_image)  as $img_index => $image)
                                                                        <div class="btn_pos"
                                                                             id="old_driver_license_img{{$img_index}}">
                                                                            <a class="btn btn-sm btn-outline-success m-1"
                                                                               download
                                                                               href="{{asset('public/credential_images/'.$image)}}">
                                                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                                                File<span class=""></span></a>
                                                                            <i class="fa fa-times-circle"
                                                                               onclick="remove_driver_license_image_image({{$img_index}})"
                                                                               title="Remove File"></i>
                                                                        </div>
                                                                        <input type="hidden"
                                                                               name="old_driver_license_image[{{$img_index}}]"
                                                                               value="{{$image}}"
                                                                               id="old_driver_license_image_{{$img_index}}"
                                                                               class="">
                                                                        @php $driverimg_cnt ++; @endphp
                                                                    @endforeach
                                                                @endif
                                                                <input type="hidden" name="driverimg_cnt"
                                                                       id="driverimg_cnt"
                                                                       value="<?php echo $driverimg_cnt;?>">
                                                            </div>
                                                            <div class="col-lg-6 provider-field">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="w9_form" name="w9_form" value="1"
                                                                           {{$credential?($credential->w9_form=='1'? 'checked':''):''}} onclick="w9_imgfield()">
                                                                    <label class="form-check-label" for="w9_form">
                                                                        W9 Form (<a
                                                                            href="https://www.irs.gov/pub/irs-pdf/fw9.pdf"
                                                                            download="W9 Form" target="_blank">Download
                                                                            Template</a>)
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 provider-field">
                                                                <label>
                                                                    <span class="text-input"><input class="img_field"
                                                                                                    id="w9_image"
                                                                                                    name="w9_form_image[]"
                                                                                                    type="file" multiple
                                                                                                    value=""
                                                                                                    placeholder=""></span>
                                                                </label>
                                                            </div>
                                                            <div class="col-12">
                                                                @if(user_doc_status(Auth::user()->user_id, 'w9_form') != null)
                                                                    @if(user_doc_status(Auth::user()->user_id, 'w9_form')->status ==2)
                                                                        <span class="badge badge-warning">
                                                                            Rejected:
                                                                            {{ user_doc_status(Auth::user()->user_id, 'w9_form')->reject_message }}
                                                                        </span>
                                                                    @elseif(user_doc_status(Auth::user()->user_id, 'w9_form')->status ==1)
                                                                        <span class="badge badge-success">
                                                                            Approved
                                                                        </span>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-12 my-3">
                                                                @php $w9img_cnt =0; @endphp
                                                                @if($credential && $credential->w9_form_image !=null)
                                                                    @foreach(explode(',',$credential->w9_form_image)  as $img_index => $image)
                                                                        <div class="btn_pos"
                                                                             id="old_w9_form_img{{$img_index}}">
                                                                            <a class="btn btn-sm btn-outline-success m-1"
                                                                               download
                                                                               href="{{asset('public/credential_images/'.$image)}}">
                                                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                                                File<span class=""></span></a>
                                                                            <i class="fa fa-times-circle"
                                                                               onclick="remove_w9_form_image({{$img_index}})"
                                                                               title="Remove File"></i>
                                                                        </div>
                                                                        <input type="hidden"
                                                                               name="old_w9_form_image[{{$img_index}}]"
                                                                               value="{{$image}}"
                                                                               id="old_w9_form_image_{{$img_index}}"
                                                                               class="">
                                                                        @php $w9img_cnt ++; @endphp
                                                                    @endforeach
                                                                @endif
                                                                <input type="hidden" name="w9img_cnt" id="w9img_cnt"
                                                                       value="<?php echo $w9img_cnt;?>">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="additional_document"
                                                                           name="additional_document" value="1"
                                                                           {{$credential?($credential->additional_document=='1'? 'checked':''):''}} onclick="additional_document_imgfield()">
                                                                    <label class="form-check-label"
                                                                           for="additional_document">
                                                                        Any additional documents for your specialty
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>
                                                                    <span class="text-input"><input class="img_field"
                                                                                                    id="additional_document_image"
                                                                                                    name="additional_document_image[]"
                                                                                                    type="file" multiple
                                                                                                    value=""></span>
                                                                </label>
                                                            </div>
                                                            <div class="col-12">
                                                                @if(user_doc_status(Auth::user()->user_id, 'additional_document') != null)
                                                                    @if(user_doc_status(Auth::user()->user_id, 'additional_document')->status ==2)
                                                                        <span class="badge badge-warning">
                                                                            Rejected:
                                                                            {{ user_doc_status(Auth::user()->user_id, 'additional_document')->reject_message }}
                                                                        </span>
                                                                    @elseif(user_doc_status(Auth::user()->user_id, 'additional_document')->status ==1)
                                                                        <span class="badge badge-success">
                                                                            Approved
                                                                        </span>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div class="col-12 my-3">
                                                                @php $additionalimg_cnt =0; @endphp
                                                                @if($credential && $credential->additional_document_image !=null)
                                                                    @foreach(explode(',',$credential->additional_document_image)  as $img_index => $image)
                                                                        <div class="btn_pos"
                                                                             id="old_additional_document_img{{$img_index}}">
                                                                            <a class="btn btn-sm btn-outline-success m-1"
                                                                               download
                                                                               href="{{asset('public/credential_images/'.$image)}}">
                                                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                                                File<span class=""></span></a>
                                                                            <i class="fa fa-times-circle"
                                                                               onclick="remove_additional_document_image({{$img_index}})"
                                                                               title="Remove File"></i>
                                                                        </div>
                                                                        <input type="hidden"
                                                                               name="old_additional_document_image[{{$img_index}}]"
                                                                               value="{{$image}}"
                                                                               id="old_additional_document_image_{{$img_index}}"
                                                                               class="">
                                                                        @php $additionalimg_cnt ++; @endphp
                                                                    @endforeach
                                                                @endif
                                                                <input type="hidden" name="additionalimg_cnt"
                                                                       id="additionalimg_cnt"
                                                                       value="<?php echo $additionalimg_cnt;?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <label>Any Additional Note</label>
                                                    <textarea name="additional_note" rows="3" placeholder="Additional Note">{{$credential?$credential->additional_note:''}}</textarea>
                                                    <button class="submit my-3 ttm-btn ttm-btn-size-md ttm-btn-shape-round ttm-btn-style-fill ttm-btn-color-skincolor float-right" type="submit">Submit
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('front_end.user.billing_form')
                        </div>
                    </div>
                </div>
            </section>
            <!--Contact Us end-->
        </div>
        <footer class="clearfix footer position-fixed w-100 widget-footer" style="bottom: 0;">
            <div class="row copyright">
                <div class="col-md-12">
                    <div class="text-center ttm-textcolor-white">
                        <span>Copyright © 2022 <a href="{{ url('/') }}">Atlantis RCM</a>. All Rights Reserved</span>
                    </div>
                </div>
            </div>
        </footer>
        <!--back-to-top end-->
    </div><!-- page end -->
@endsection
@section('footer-scripts')
    <!-- nav tabs js start-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <!-- nav tabs js End-->
    <script>
        $(document).ready(function () {
            change_form($("input[name='form_type']:checked").val())

            // checking url
            var loc = window.location;
            var current_url = loc.href.split('#');
            if(current_url[1] == 'profile/') {
                $('#profile-tab').trigger('click');
            } else if(current_url[1] == 'billing/'){
                $('#billing-tab').trigger('click');
            } else {
                $('#credentialing-tab').trigger('click');
            }
            // checking url
        });
        $(".form-type").click(function () {
            change_form($(this).attr("value"))
        });

        function change_form(type) {
            if (type == 'credentialing_agencies') {
                $('#credentialing_form_id').removeClass('d-none')
                $('#credentialing_form_id').addClass('d-block')
                $('.provider-field').addClass('d-none')
                $('.provider-field').removeClass('d-block')
            } else if (type == 'credentialing_individual_provider') {
                $('#credentialing_form_id').removeClass('d-none')
                $('#credentialing_form_id').addClass('d-block')
                $('.provider-field').removeClass('d-none')
                $('.provider-field').addClass('d-block')
            }
        }

        function form_submit() {
            let data = new FormData($('#credentialing_form')[0]);
            let a = function () {
                // window.location.reload();
                var loc = window.location;
                $(location).attr('href','http://'+loc.host+loc.pathname+'/#credentialing/');
            };
            let arr = [a];
            call_ajax_with_functions('', '{{route('credentialing_form_save')}}', data, arr);
        }

        function remove_state_license_image(image) {
            document.getElementById("old_state_license_img" + image).classList.add("d-none");
            document.getElementById("old_state_license_image_" + image).remove();

            var stateimg_cnt = $('#stateimg_cnt').val();
            $('#stateimg_cnt').val(stateimg_cnt - 1);
            var state_checkbox = $('#state_license').is(':checked');
            if (stateimg_cnt - 1 == 0 && state_checkbox == true) {
                $('#state_image').attr("required", 'required');
            }
        }

        function remove_accreditation_image(image) {
            document.getElementById("old_accreditation_img" + image).classList.add("d-none");
            document.getElementById("old_accreditation_image_" + image).remove();

            var credentialimg_cnt = $('#credentialimg_cnt').val();
            $('#credentialimg_cnt').val(credentialimg_cnt - 1);
            var accreditation_checkbox = $('#accreditation').is(':checked');
            if (credentialimg_cnt - 1 == 0 && accreditation_checkbox == true) {
                $('#accreditation_image').attr("required", 'required');
            }
        }

        function remove_irs_letter_image(image) {
            document.getElementById("old_irs_letter_img" + image).classList.add("d-none");
            document.getElementById("old_irs_letter_image_" + image).remove();

            var irsimg_cnt = $('#irsimg_cnt').val();
            $('#irsimg_cnt').val(irsimg_cnt - 1);
            var irs_checkbox = $('#irs_letter').is(':checked');
            if (irsimg_cnt - 1 == 0 && irs_checkbox == true) {
                $('#irs_letter_image').attr("required", 'required');
            }
        }

        function remove_bank_letter_image(image) {
            document.getElementById("old_bank_letter_img" + image).classList.add("d-none");
            document.getElementById("old_bank_letter_image_" + image).remove();

            var bankimg_cnt = $('#bankimg_cnt').val();
            $('#bankimg_cnt').val(bankimg_cnt - 1);
            var bank_checkbox = $('#bank_letter').is(':checked');
            if (bankimg_cnt - 1 == 0 && bank_checkbox == true) {
                $('#banck_letter_image').attr("required", 'required');
            }
        }

        function remove_professional_liability_insurance_image(image) {
            document.getElementById("old_professional_liability_insurance_img" + image).classList.add("d-none");
            document.getElementById("old_professional_liability_insurance_image_" + image).remove();

            var professionalimg_cnt = $('#professionalimg_cnt').val();
            $('#professionalimg_cnt').val(professionalimg_cnt - 1);
            var professional_checkbox = $('#professional_liability_insurance').is(':checked');
            if (professionalimg_cnt - 1 == 0 && professional_checkbox == true) {
                $('#professional_image').attr("required", 'required');
            }
        }

        function remove_driver_license_image_image(image) {
            document.getElementById("old_driver_license_img" + image).classList.add("d-none");
            document.getElementById("old_driver_license_image_" + image).remove();

            var driverimg_cnt = $('#driverimg_cnt').val();
            $('#driverimg_cnt').val(driverimg_cnt - 1);
            var driver_checkbox = $('#driver_license').is(':checked');
            if (driverimg_cnt - 1 == 0 && driver_checkbox == true) {
                $('#drivers_image').attr("required", 'required');
            }
        }

        function remove_w9_form_image(image) {
            document.getElementById("old_w9_form_img" + image).classList.add("d-none");
            document.getElementById("old_w9_form_image_" + image).remove();

            var w9img_cnt = $('#w9img_cnt').val();
            $('#w9img_cnt').val(w9img_cnt - 1);
            var w9_form_checkbox = $('#w9_form').is(':checked');
            if (w9img_cnt - 1 == 0 && w9_form_checkbox == true) {
                $('#w9_image').attr("required", 'required');
            }
        }

        function remove_additional_document_image(image) {
            document.getElementById("old_additional_document_img" + image).classList.add("d-none");
            document.getElementById("old_additional_document_image_" + image).remove();

            var additionalimg_cnt = $('#additionalimg_cnt').val();
            $('#additionalimg_cnt').val(additionalimg_cnt - 1);
            var additional_document_checkbox = $('#additional_document').is(':checked');
            if (additionalimg_cnt - 1 == 0 && additional_document_checkbox == true) {
                $('#additional_document_image').attr("required", 'required');
            }
        }

        var state_imgfield_val = 0;

        function state_imgfield() {
            if (state_imgfield_val == 0) {
                state_imgfield_val = 1;
                $('#state_image').removeClass('img_field');
                if ($('#stateimg_cnt').val() == 0) {
                    $('#state_image').attr("required", 'required');
                    $('#state_image').attr("disabled", false);
                }
            } else {
                state_imgfield_val = 0;
                $('#state_image').addClass('img_field');
                $('#state_image').attr("required", false);
                $('#state_image').attr("disabled", true);
                $('#state_image').val('');
            }
        }

        var accreditation_imgfield_val = 0;

        function accreditation_imgfield() {
            if (accreditation_imgfield_val == 0) {
                accreditation_imgfield_val = 1;
                $('#accreditation_image').removeClass('img_field');
                if ($('#credentialimg_cnt').val() == 0) {
                    $('#accreditation_image').attr("required", 'required');
                    $('#accreditation_image').attr("disabled", false);
                }
            } else {
                accreditation_imgfield_val = 0;
                $('#accreditation_image').addClass('img_field');
                $('#accreditation_image').attr("required", false);
                $('#accreditation_image').attr("disabled", true);
                $('#accreditation_image').val('');
            }
        }

        var irs_imgfield_val = 0;

        function irs_imgfield(e) {
            if (irs_imgfield_val == 0) {
                irs_imgfield_val = 1;
                $('#irs_letter_image').removeClass('img_field');
                if ($('#irsimg_cnt').val() == 0) {
                    $('#irs_letter_image').attr("required", 'required');
                    $('#irs_letter_image').attr("disabled", false);
                }
            } else {
                irs_imgfield_val = 0;
                $('#irs_letter_image').addClass('img_field');
                $('#irs_letter_image').attr("required", false);
                $('#irs_letter_image').attr("disabled", true);
                $('#irs_letter_image').val('');
            }
        }

        var banck_imgfield_val = 0;

        function bancklettter_imgfield() {
            if (banck_imgfield_val == 0) {
                banck_imgfield_val = 1;
                $('#banck_letter_image').removeClass('img_field');
                if ($('#bankimg_cnt').val() == 0) {
                    $('#banck_letter_image').attr("required", 'required');
                    $('#banck_letter_image').attr("disabled", false);
                }
            } else {
                banck_imgfield_val = 0;
                $('#banck_letter_image').addClass('img_field');
                $('#banck_letter_image').attr("required", false);
                $('#banck_letter_image').attr("disabled", true);
                $('#banck_letter_image').val('');
            }
        }

        var professional_imgfield_val = 0;

        function professional_imgfield() {
            if (professional_imgfield_val == 0) {
                professional_imgfield_val = 1;
                $('#professional_image').removeClass('img_field');
                if ($('#professionalimg_cnt').val() == 0) {
                    $('#professional_image').attr("required", 'required');
                    $('#professional_image').attr("disabled", false);
                }
            } else {
                professional_imgfield_val = 0;
                $('#professional_image').addClass('img_field');
                $('#professional_image').attr("required", false);
                $('#professional_image').attr("disabled", true);
                $('#professional_image').val('');
            }
        }

        var drivers_imgfield_val = 0;

        function drivers_imgfield() {
            if (drivers_imgfield_val == 0) {
                drivers_imgfield_val = 1;
                $('#drivers_image').removeClass('img_field');
                if ($('#driverimg_cnt').val() == 0) {
                    $('#drivers_image').attr("required", 'required');
                    $('#drivers_image').attr("disabled", false);
                }
            } else {
                drivers_imgfield_val = 0;
                $('#drivers_image').addClass('img_field');
                $('#drivers_image').attr("required", false);
                $('#drivers_image').attr("disabled", true);
                $('#drivers_image').val('');
            }
        }

        var w9_imgfield_val = 0;

        function w9_imgfield() {
            if (w9_imgfield_val == 0) {
                w9_imgfield_val = 1;
                $('#w9_image').removeClass('img_field');
                if ($('#w9img_cnt').val() == 0) {
                    $('#w9_image').attr("required", 'required');
                    $('#w9_image').attr("disabled", false);
                }
            } else {
                w9_imgfield_val = 0;
                $('#w9_image').addClass('img_field');
                $('#w9_image').attr("required", false);
                $('#w9_image').attr("disabled", true);
                $('#w9_image').val('');
            }
        }

        var additional_document_imgfield_val = 0;

        function additional_document_imgfield() {
            if (additional_document_imgfield_val == 0) {
                additional_document_imgfield_val = 1;
                $('#additional_document_image').removeClass('img_field');
                if ($('#additionalimg_cnt').val() == 0) {
                    $('#additional_document_image').attr("required", 'required');
                    $('#additional_document_image').attr("disabled", false);
                }
            } else {
                additional_document_imgfield_val = 0;
                $('#additional_document_image').addClass('img_field');
                $('#additional_document_image').attr("required", false);
                $('#additional_document_image').attr("disabled", true);
                $('#additional_document_image').val('');
            }
        }

        $(document).ready(function () {
            if ($('#state_license').is(':checked') == true) {
                state_imgfield_val = 1;
                $('#state_image').removeClass('img_field');
            } else{
                $('#state_image').attr("disabled", true);
            }
            if ($('#accreditation').is(':checked') == true) {
                accreditation_imgfield_val = 1;
                $('#accreditation_image').removeClass('img_field');
            } else{
                $('#accreditation_image').attr("disabled", true);
            }
            if ($('#irs_letter').is(':checked') == true) {
                irs_imgfield_val = 1;
                $('#irs_letter_image').removeClass('img_field');
            } else{
                $('#irs_letter_image').attr("disabled", true);
            }
            if ($('#bank_letter').is(':checked') == true) {
                banck_imgfield_val = 1;
                $('#banck_letter_image').removeClass('img_field');
            } else{
                $('#banck_letter_image').attr("disabled", true);
            }
            if ($('#professional_liability_insurance').is(':checked') == true) {
                professional_imgfield_val = 1;
                $('#professional_image').removeClass('img_field');
            } else{
                $('#professional_image').attr("disabled", true);
            }
            if ($('#driver_license').is(':checked') == true) {
                drivers_imgfield_val = 1;
                $('#drivers_image').removeClass('img_field');
            } else{
                $('#drivers_image').attr("disabled", true);
            }
            if ($('#w9_form').is(':checked') == true) {
                w9_imgfield_val = 1;
                $('#w9_image').removeClass('img_field');
            } else{
                $('#w9_image').attr("disabled", true);
            }
            if ($('#additional_document').is(':checked') == true) {
                additional_document_imgfield_val = 1;
                $('#additional_document_image').removeClass('img_field');
            } else{
                $('#additional_document_image').attr("disabled", true);
            }
        });

    </script>
@endsection
<style>
    .btn_pos {
        position: relative;
        display: inline;
    }
    .btn_pos > i.fa-times-circle {
        position: absolute;
        top: -19px;
        font-size: 21px;
        color: red;
        right: -2px;
        cursor: pointer;
    }
    .img_field {
        visibility: hidden;
    }
    .nav-btn-cl{
        color: #495057;
        background-color: #fff;
        border-color: #dee2e6 #dee2e6 #fff;
    }
    .nav-link.active{
        color: #ffffff !important;
        background-color: #009dd8 !important;
        border-color: #dee2e6 #dee2e6 #fff !important;
    }
</style>
