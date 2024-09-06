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
                        <img src="{{asset('public/assets/images/individual.png')}}" alt="">
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
                                    <a href="#" class="mx-2">Logout</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-8 col-12">
                    <div class="">
                        <h5 class="text-grey mt-3 mt-lg-0">Hi,<span class="text-seafoam fw-bold mx-2">{{Auth::user()->full_name}} </span></h5>
                        <p class="text-grey">Welcome to Atlantis RCM</p>
                        <div class="insurance-strip text-white p-2">
                            <span>Accounts</span>
                        </div>
                        <div  style="padding: 15px; background-color: white">
                            <form action="javascript:user_form_update()" id="user_form_update_id">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="username">User Name:</label>
                                            <input type="text" name="full_name" id="" value="{{Auth::user()->full_name}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="username">Old Password:</label>
                                            <input type="password" name="old_password" id="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="username">New Password:</label>
                                            <input type="password" name="new_password" id="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="username">Confirm Password:</label>
                                            <input type="password" name="" id="c_password" class="form-control">
                                            <small class="text-danger password_text"></small>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary float-right">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <form id="file_form" class="d-none"  action="javascript:add_file();" enctype="multipart/form-data">
                            @csrf
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>User List</label>
                                        <input id="file" name="file" type="file" class="filter form-control" value="" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mr-5 mt-2">
                                        <button type="submit" class="btn btn-primary mt-4 float-right">Upload</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
@section('footer-scripts')
    <script>
        function user_form_update(){
            if ($('#c_password').val()!=$('#password').val()){
                $('.password_text').text('Password Not Matched!')
                return false
            }
            let data=new FormData($('#user_form_update_id')[0])
            let a=function(){
                setTimeout(()=>window.location.reload(),1000)
            }
            let arr=[a];
            call_ajax_div_with_functions('','{{route('update_user_profile')}}',data,arr);
        }
        function add_file(){
            let data=new FormData($('#file_form')[0])
            let a=function(){
            }
            let arr=[a];
            call_ajax_div_with_functions('','{{route('add_file')}}',data,arr);
        }
    </script>
@endsection
