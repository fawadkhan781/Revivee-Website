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
    </style>
@endsection
@section('content')
    <!-- Profile Status Section -->

    <section class="doctor_overview">
        <div class="container">
            <div class="row mt-5 ">
                <div class="col-lg-4 pt-lg-3 mt-lg-5">
                    <div class="customer_profile d-flex flex-column align-items-center p-4 mt-2">
                        <img src="{{asset('public/assets/images/group.png')}}" alt="">
                        <h4 class="text-light text-center">{{Auth::user()->full_name}}</h4>
                    </div>
                    <div class="profile_status  ms-md-3 ms-4 p-4">
                        <div class="container">
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
                        <h5 class="text-grey mt-3 mt-lg-0">Hi,<span class="text-seafoam fw-bold mx-2">{{Auth::user()->full_name}}</span></h5>
                        <p class="text-grey">Welcome to Atlantis RCM</p>
                            <div class="insurance-strip text-white-50 p-2 d-flex justify-content-between">
                            </div>
                            <div class="float-right mt-1 text-info mr-2" style="font-size: 13px;">
                                <a href="{{route('group_dashboard')}}">
                                    Dashboard</a>
                            </div>
                        <div class="user_dashboad_profilcards">
                            <div class="list-insurance-companies">
                                <h5 class="fw-bold text-grey pt-2 fs-5">Status
                                </h5>
                                <a href="{{route('view_form')}}" class="btn btn-outline-info float-right btn-sm" >Add Group</a>
                                <p class="pt-1 text-grey fs-6">Registered Groups of {{Auth::user()->full_name}}</p>
                            </div>
                            <div class="row">
                                @foreach($user->group_credential as $credential)
                                    <div class="col-lg-4 col-12 col-md-6 hover_div mt-4">
                                        <div class="jame-hut text-center justify-content-center align-items-center">
                                            <img src="{{asset('public/assets/images/group.png')}}" class="card_profile_image mt-5">
                                            <div class="profile_card_content mx-1">
                                                <p class="text-grey m-0 fw-bold user_name">{{$credential->group_name}}</p>
                                                <p class="text-seafoam m-0 fw-bold">NPI:{{$credential->group_npi}}</p>
                                            </div>
                                            <a href="{{route('user_dashboard',$credential->credential_id)}}">
                                            <div class="view d-flex flex-column align-items-center justify-content-center">
                                                    <p>Group {{$loop->index+1}}</p>
                                            </div>
                                            </a>
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
                                                <div class="del_icon_user position-absolute d-none" onclick="delete_credential({{$credential->credential_id}})">
                                                    <i class="fa fa-trash text-danger"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer-scripts')
    <script>
        {{--function delete_credential(id){--}}
        {{--    let data = new FormData();--}}
        {{--    data.append('_token', '{{csrf_token()}}');--}}
        {{--    data.append('id', id)--}}
        {{--    let a = function () {--}}
        {{--        setTimeout(function () {--}}
        {{--            window.location.reload();--}}
        {{--        }, 1000);--}}
        {{--    };--}}
        {{--    let arr = [a];--}}
        {{--    Swal.fire({--}}
        {{--        title: 'Are you sure?',--}}
        {{--        text: "You want to delete it!",--}}
        {{--        type: 'warning',--}}
        {{--        showCancelButton: true,--}}
        {{--        confirmButtonColor: '#3085d6',--}}
        {{--        cancelButtonColor: '#d33',--}}
        {{--        confirmButtonText: 'Yes, delete it!'--}}
        {{--    }).then((willDelete) => {--}}
        {{--        if (willDelete.value) {--}}
        {{--            call_ajax_div_with_functions('', '{{route('delete_credential')}}', data, arr);--}}
        {{--        } else {--}}
        {{--            Swal.fire("Your Provider Info is safe!");--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}
    </script>
@endsection
