@extends('front_end.layout.main')
@section('header-scripts')
    <link rel="stylesheet" href="{{asset('public/assets/css/credential.css')}}">
    <style>
        .user_timeline_anchor{
            text-decoration: none !important;
        }
        .user_timeline_anchor:hover{
            color:#78ccdc;
        }
        a{
            text-decoration: none !important;
        }
        .del_icon_user {
            width: 20px;
            height: auto;
            top: 5px;
            right: 10px;
            z-index: 1030;
            cursor: pointer;
        }
        button.close:focus {
            outline:none !important;
        }
    </style>
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
                        <p class="text-light">{{$credential->form_type=='credentialing_agencies'?$credential->group_npi:$credential->provider_npi}}</p>
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
                        <h5 class="text-grey mt-3 mt-lg-0">Hi,<span class="text-seafoam fw-bold mx-2">{{$credential->legal_name}}</span></h5>
                        <p class="text-grey">Welcome to Atlantis RCM</p>
                        <div class="insurance-strip text-white-50 p-2 d-flex justify-content-between">
                            <h5 class="text-light">{{$credential->form_type=='credentialing_agencies'?$credential->group_name:$credential->provider_name}}</h5>
                        </div>
                        @if(count(Auth::user()->group_credential)>0)
                            <div class="float-right mt-1 text-grey mr-2" style="font-size: 13px;">
                                <a href="{{route('group_dashboard')}}">
                                    Dashboard</a> <i class="fa fa-chevron-right fs-4"></i>
                                <a href="{{route('user_dashboard',$credential->parent_id!=null?$credential->parent_id:$credential->credential_id)}}" class="text-info">
                                    Group Providers</a>
                            </div>
                        @else
                            <div class="float-right mt-1 text-grey mr-2" style="font-size: 13px;">
                                <a href="" class="text-info">
                                    Insurances</a>
                            </div>
                        @endif
                        <div class="user_dashboad_profilcards">
                            <div class="list-insurance-companies">
                            @if($credential->form_type=='credentialing_agencies')
                                <h5 class="fw-bold text-grey pt-2 fs-5">Status</h5>
                                    <button type="button" class="btn btn-outline-info btn-sm float-right"  onclick="provider_list({{$credential->credential_id}})">
                                        Add Provider
                                    </button>
                                    <p class="pt-1 text-grey fs-6">Registered providers of {{$credential->group_name}}</p>
                            @else
                                 <h5 class="fw-bold text-grey pt-2 fs-5">List Of Insurance Companies</h5>
                                 <p class="pt-1 text-grey fs-6">Registered Insurance Companies of {{$credential->provider_name}}</p>
                            @endif
                            </div>
                            @if($credential->form_type=='credentialing_agencies')
                            <div class="row">
                                @foreach($credential->child_credentials as $credential)
                                    <div class="col-lg-4 col-12 col-md-6 hover_div mt-4">
                                        <div class="jame-hut d-flex justify-content-center align-items-center">
                                            <img src="{{asset('public/assets/images/individual.png')}}" class="card_profile_image">
                                            <div class="profile_card_content mx-1">
                                                <p class="text-grey m-0 fw-bold user_name">{{$credential->provider_name}}</p>
                                                <p class="text-seafoam m-0 fw-bold">NPI:{{$credential->provider_npi}}</p>
                                            </div>
                                                <div class="view d-flex flex-column align-items-center justify-content-center">
                                                    <a href="{{route('view_individual_credential',$credential->credential_id)}}">
                                                    <p>View Insurances</p>
                                                    </a>
                                                </div>
                                            @php
                                                $approved_status=0;
                                                if($credential!=null && $credential->document_status_tab_view!=null)
                                                {
                                                    $approved_status = $approved_status + $credential->document_status_tab_view->approved;
                                                }
                                                if($credential!=null && $credential->login_status_tab_view!=null){
                                                    $approved_status = $approved_status + $credential->login_status_tab_view->approved;
                                                }
                                                if($credential!=null && $credential->individual_status_tab!=null){
                                                    $approved_status = $approved_status + $credential->individual_status_tab->approved;
                                                }
                                            @endphp
                                            @if($approved_status == 0)
                                                <div class="del_icon_user position-absolute" onclick="delete_credential({{$credential->credential_id}})">
                                                    <i class="fa fa-trash text-danger"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @else
                                <div class="row p-4">
                                    <table class="table">
                                        <thead class="text-grey" style="background-color: #f9fcfc;">
                                        <tr>
                                            <th>Insurance Name</th>
                                            <th>Category</th>
                                            <th>Last Updated</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-grey">
                                        @foreach($credential->insurances as $insurance)
                                            <tr>
                                                <td class="font-weight-bold"><a href="{{route('user_timeline',[$credential->credential_id,$insurance->id])}}" class="user_timeline_anchor">{{$insurance->title}}</a></td>
                                                <td>Credentialing</td>
                                                <td>{{$insurance->pivot->last_update_date!=null?date('d F Y',strtotime($insurance->pivot->last_update_date)):''}}</td>
                                                <td>{{ $insurance->pivot->insurance_status }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
{{--    Modal For Add Providers--}}
    <div class="modal fade" id="add_providers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" style="z-index: -1;">
                <div class="bg-primary insurance-strip modal-header text-white" style="height: 61px;border-radius: 0px;">
                    <h4 class="modal-title ml-auto" id="exampleModalLabel">Select Available Providers</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 1 !important;">
                        <span aria-hidden="true" class="close_modal text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-5" id="provider_list_div">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-scripts')
    <script>
        $('.close_modal').click(function(){
           $('#add_providers').modal('hide');
        });
        $('#new_provider').click(function(){
            $('#add_new_providers').removeClass('d-none');
        });
        function delete_credential(id){
            let data = new FormData();
            data.append('_token', '{{csrf_token()}}');
            data.append('id', id)
            let a = function () {
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            };
            let arr = [a];
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete it!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((willDelete) => {
                if (willDelete.value) {
                    call_ajax_div_with_functions('', '{{route('delete_credential')}}', data, arr);
                } else {
                    Swal.fire("Your Provider Info is safe!");
                }
            });
        }
        function provider_list(id){
            let data = new FormData();
            data.append('_token', '{{csrf_token()}}');
            data.append('id', id)
            let a = function () {
                $('#add_providers').modal('show');
            };
            let arr = [a];
            call_ajax_div_with_functions('provider_list_div', '{{route('provider_list')}}', data, arr);
        }
        function add_previous_provider(){
            let data=new FormData($('#previous_provider_id')[0])
            let a = function () {
                window.location.reload();
            };
            let arr = [a];
            call_ajax_div_with_functions('', '{{route('add_previous_provider')}}', data, arr);
        }
    </script>
@endsection
