<style>
    .user_time_line_block {
        background-color: #FFFFFF;
        padding: 15px;
    }
    .timeline_button{
        padding: 2px 8px 4px 9px;
        border-radius: 10px;
        border: solid 1px #5d6566;
        background-color: #1770df;
        color: white;
    }
    .time_line_content {
        position: relative;
    }
    .time_line_content:before {
        content: " ";
        position: absolute;
        left: -14px;
        top: 20px;
        border-top: 10px solid transparent;
        border-right: 15px solid white;
        border-left: none;
        border-bottom: 10px solid transparent;
        filter: drop-shadow(-1px 0px 0px #dee2e6);
    }
    .time_line_content:hover {
        background-image: linear-gradient(to top, #0017ec, #00cebd);
        border: solid 1px #fff;
        color: white!important;
    }
    .time_line_content:hover::before {
        border-right: 15px solid var(--bg_blue);
    }
    .time_line_content:hover h5,
    .time_line_content:hover p{
        color: #fff;
    }
    .time_line_content:hover a
    {
        background-color: white;
        color: #1770df;
        border: solid 1px #fff;
    }



    .line {
        border-left: 2px solid #1770df;
        height: 100%;
        position: relative;
    }
    .circle {
        width: 23px;
        height: 23px;
        border-radius: 50%;
        background-color: #1770df;
        position: absolute;
        left: -64px;
        top: 15px;
    }
    .circle-2{

        top: 355px;
    }
    .circle-3{

        top: 663px;
    }
</style>
@extends('front_end.layout.main')
@section('header-scripts')
    <link rel="stylesheet" href="{{asset('public/assets/css/credential.css')}}">
@endsection
@section('content')
    <!-- Profile Status Section -->
    <section class="doctor_overview">
        <div class="container">
            <div class="row mt-5 ">
                <div class="col-lg-4 pt-lg-3 mt-lg-5">
                    <div class="customer_profile d-flex flex-column align-items-center p-4 mt-2">
                        <img src="{{$credential->form_type=='credentialing_agencies'?asset('public/assets/images/group.png'):asset('public/assets/images/individual.png')}}" alt="">
                        <h4 class="text-light text-center">{{$credential->form_type=='credentialing_agencies'?$credential->group_name:$credential->provider_name}}</h4>
                        <p class="text-light">{{$credential->ein_tin}}</p>
                    </div>
                    <div class="profile_status  ms-md-3 ms-4 p-4">
                        <div class="container">
                            <div class="overview">
                                <h5 class="text-grey">Overview</h5>
                                <p class="pt-1 text-grey fs-4 ">Profile Status</p>
                                <a href="{{route('view_individual_credential',$credential->credential_id.'/2')}}" class="d-flex">
                                    @if($credential->form_type=='credentialing_agencies')
                                        @php $approved_group_info=0; if ($credential->group_status_tab !=null){ $approved_group_info = $credential->group_status_tab->approved*100/6;} @endphp
                                        <div class="progress profile_progress {{$credential->form_type=='credentialing_agencies'?($credential->group_status_tab !=null?'profile_Credential':''):($credential->individual_status_tab !=null?'profile_Credential':'')}} mt-4 w-75" role="progressbar"
                                             aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar" style="width: {{$approved_group_info}}%"></div>
                                        </div>
                                        @if($credential->group_status_tab !=null && $credential->group_status_tab->unapproved > 0)
                                            <i class="fa fa-exclamation-circle text-danger ml-1" style="margin-top: 19px; font-size: 20px;"></i>
                                        @endif
                                    @else
                                        @php $approved_individual_info=0; if ($credential->individual_status_tab !=null){ $approved_individual_info = $credential->individual_status_tab->approved*100/12;} @endphp
                                        <div class="progress profile_progress {{$credential->form_type=='credentialing_agencies'?($credential->group_status_tab !=null?'profile_Credential':''):($credential->individual_status_tab !=null?'profile_Credential':'')}} mt-4 w-75" role="progressbar"
                                             aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar" style="width: {{$approved_individual_info}}%"></div>
                                        </div>
                                        @if($credential->individual_status_tab !=null && $credential->individual_status_tab->unapproved > 0)
                                            <i class="fa fa-exclamation-circle text-danger ml-1" style="margin-top: 19px; font-size: 20px;"></i>
                                        @endif
                                    @endif
                                </a>
                                <p class="text-grey pt-1">Personal Details</p>
                                @if($credential->form_type!='credentialing_agencies')
                                    <a href="{{route('view_individual_credential',$credential->credential_id.'/3')}}" class="d-flex">
                                        @php $approved_login=0; if ($credential->login_status_tab_view !=null){ $approved_login = $credential->login_status_tab_view->approved*100/9;} @endphp
                                        <div class="progress profile_progress {{$credential->login_status_tab_view !=null?'profile_Credential':''}} w-75 mt-3" role="progressbar"
                                             aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar" style="width: {{$approved_login}}%"></div>
                                        </div>
                                        @if($credential->login_status_tab_view !=null && $credential->login_status_tab_view->unapproved > 0)
                                            <i class="fa fa-exclamation-circle text-danger ml-1" style="margin-top: 10px; font-size: 20px;"></i>
                                        @endif
                                    </a>
                                    <p class="text-grey pt-1">Login Credientials</p>
                                @endif
                                @if($credential->form_type=='credentialing_agencies')
                                    <a href="{{route('view_individual_credential',$credential->credential_id.'/3')}}" class="d-flex">
                                        @php $approved_document=0; if ($credential->document_status_tab_view !=null){ $approved_document = $credential->group_document_status_tab_view->approved*100/5;} @endphp
                                        <div class="progress profile_progress {{$credential->group_document_status_tab_view !=null?'profile_Credential':''}} w-75 mt-3" role="progressbar"
                                             aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar" style="width: {{$approved_document}}%"></div>
                                        </div>
                                        @if($credential->group_document_status_tab_view !=null && $credential->group_document_status_tab_view->unapproved > 0)
                                            <i class="fa fa-exclamation-circle text-danger ml-1" style="margin-top: 10px; font-size: 20px;"></i>
                                        @endif
                                    </a>
                                @elseif($credential->parent_id!=null)
                                    <a href="{{route('view_individual_credential',$credential->credential_id.'/5')}}" class="d-flex">
                                        @php $approved_document=0; if ($credential->document_status_tab_view !=null){ $approved_document = $credential->document_status_tab_view->approved*100/11;} @endphp
                                        <div class="progress profile_progress {{$credential->document_status_tab_view !=null?'profile_Credential':''}} w-75 mt-3" role="progressbar"
                                             aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar" style="width: {{$approved_document}}%"></div>
                                        </div>
                                        @if($credential->document_status_tab_view !=null && $credential->document_status_tab_view->unapproved > 0)
                                            <i class="fa fa-exclamation-circle text-danger ml-1" style="margin-top: 10px; font-size: 20px;"></i>
                                        @endif
                                    </a>
                                @else
                                    <a href="{{route('view_individual_credential',$credential->credential_id.'/5')}}" class="d-flex">
                                        @php $approved_document=0; if ($credential->document_status_tab_view !=null){ $approved_document = $credential->document_status_tab_view->approved*100/11;} @endphp
                                        <div class="progress profile_progress {{$credential->document_status_tab_view !=null?'profile_Credential':''}} w-75 mt-3" role="progressbar"
                                             aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar" style="width: {{$approved_document}}%"></div>
                                        </div>
                                        @if($credential->document_status_tab_view !=null && $credential->document_status_tab_view->unapproved > 0)
                                            <i class="fa fa-exclamation-circle text-danger ml-1" style="margin-top: 10px; font-size: 20px;"></i>
                                        @endif
                                    </a>
                                @endif
                                <p class="text-grey pt-1">Documents</p>
                            </div>
                            <div class="account_setting_sidebar  mt-5 ">
                                <div class="account d-flex align-items-center gap-3 mt-3">
                                    <i class="fa fa-user fs-4  "></i>
                                    <a href="{{route('user_form_account')}}" class="mx-2">Account</a>
                                </div>
                                <div class="account d-flex align-items-center gap-3 mt-3">
                                    <i class="fa fa-arrow-right fs-4  "></i>
                                    <a href="{{route('logout')}}" class="mx-2">Logout</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- insurance list table  -->
                <div class="col-lg-8 col-12">
                    <div class="">
                        <h5 class="text-grey mt-3 mt-lg-0">Hi,<span class="text-seafoam fw-bold mx-2">{{$credential->legal_name}} </span></h5>
                        <p class="text-grey">Welcome to Atlantis RCM</p>
                        <div class="insurance-strip text-white p-2">
                            <span>{{$user_insurance->insurance->title}}</span>
                            @if(isset($user_insurance->insurance_status))
                            <span class="float-right">Status : {{$user_insurance->insurance_status}}</span>
                            @endif
                        </div>
                        @if(count(Auth::user()->group_credential)>0)
                        <div class="float-right mt-1 mr-2 text-grey" style="font-size: 13px;">
                            <a href="{{route('group_dashboard')}}">
                                Dashboard</a> <i class="fa fa-chevron-right fs-4"></i>
                            <a href="{{route('user_dashboard',$credential->parent_id!=null?$credential->parent_id:$credential->credential_id)}}" >
                                Group Providers</a> <i class="fa fa-chevron-right fs-4"></i> <a href="{{route('view_individual_credential',$credential->credential_id)}}" >
                                Insurances</a> <i class="fa fa-chevron-right fs-4"></i> <a href="" class="text-info">
                                Insurance Timelines</a>
                        </div>
                        @else
                        <div class="float-right mt-1 mr-2 text-grey" style="font-size: 13px;">
                            <a href="{{route('user_dashboard')}}" >
                                Insurances</a>
                             <i class="fa fa-chevron-right fs-4"></i>
                            <a href="" class="text-info">
                                Insurance Timelines</a>
                        </div>
                        @endif
                        <div class="user_time_line_block">
                        <div class="time_line">
                            <h5 class="fw-1 text-grey pt-2 fs-5 ml-5">Insurance Timelines</h5>
                            <div class="row pt-4 p-5">
                                <div class="col-1 d-none d-md-block ">
                                    <div class="line">

                                    </div>
                                </div>
                                <div class="col-11 pt-4">
                                    @foreach($user_insurance->insurance_timeline as $timeline)
                                    <div class="time_line_content p-4 border mt-4">
                                        <div class="circle"></div>
                                        <div class="timeline_date d-flex justify-content-between">
                                            <p class="text-grey mb-1 mt-n1" style="font-size: 13px">{{date('d F Y',strtotime($timeline->created_at))}}</p>
{{--                                            <a href="" class="timeline_button">View Full History</a>--}}
                                        </div>
                                        <div class="provide_details mb-n3">
                                            <p class="text-grey">{{$timeline->message}}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
@section('footer-scripts')

@endsection
