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
                            <a href="{{route('logout')}}" class="mx-2">Logout</a>
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="year" value="{{isset($year)?$year:''}}">
                <div class="col-lg-8 col-12" id="billing_folders_div">
                    <div class="">
                        <h5 class="text-grey mt-3 mt-lg-0">Hi,<span class="text-seafoam fw-bold mx-2">{{Auth::user()->full_name}}</span></h5>
                        <p class="text-grey">Welcome to Atlantis RCM</p>
                        <div class="insurance-strip p-2" style="font-size: 15px;">
                        </div>
                        <div class="user_dashboad_profilcards">
                            <div class="container">
                                <h2 class="text-center text-info">{{$year}}</h2>
                                <div class="row p-4">
                                    <div class=" p-4 ">
                                        <div class="card {{$month=='January'?'bg-info':'bg-dark'}} p-2" onclick="billing_folders(1)">
                                            <div class="text-white">
                                                <h3 class="text-uppercase">Jan</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <div class="card p-2 {{$month=='February'?'bg-info':'bg-dark'}}" onclick="billing_folders(2)">
                                            <div class=" text-white">
                                                <h3 class="text-uppercase">Feb</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <div class="card p-2 {{$month=='March'?'bg-info':'bg-dark'}}" onclick="billing_folders(3)">
                                            <div class=" text-white">
                                                <h3 class="text-uppercase">Mar</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <div class="card p-2 {{$month=='April'?'bg-info':'bg-dark'}}" onclick="billing_folders(4)">
                                            <div class=" text-white">
                                                <h3 class="text-uppercase">Apr</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <div class="card p-2 {{$month=='May'?'bg-info':'bg-dark'}}" onclick="billing_folders(5)">
                                            <div class=" text-white">
                                                <h3 class="text-uppercase">May</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <div class="card p-2 {{$month=='June'?'bg-info':'bg-dark'}}" onclick="billing_folders(6)">
                                            <div class=" text-white">
                                                <h3 class="text-uppercase">Jun</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <div class="card p-2 {{$month=='July'?'bg-info':'bg-dark'}}" onclick="billing_folders(7)">
                                            <div class=" text-white">
                                                <h3 class="text-uppercase">Jul</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <div class="card p-2 {{$month=='August'?'bg-info':'bg-dark'}}" onclick="billing_folders(8)">
                                            <div class=" text-white">
                                                <h3 class="text-uppercase">Aug</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <div class="card p-2 {{$month=='September'?'bg-info':'bg-dark'}}" onclick="billing_folders(9)">
                                            <div class=" text-white">
                                                <h3 class="text-uppercase">Sep</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <div class="card p-2 {{$month=='October'?'bg-info':'bg-dark'}}" onclick="billing_folders(10)">
                                            <div class=" text-white">
                                                <h3 class="text-uppercase">Oct</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <div class="card p-2 {{$month=='November'?'bg-info':'bg-dark'}}" onclick="billing_folders(11)">
                                            <div class=" text-white">
                                                <h3 class="text-uppercase">Nov</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <div class="card p-2 {{$month=='December'?'bg-info':'bg-dark'}}" onclick="billing_folders(12)">
                                            <div class=" text-white">
                                                <h3 class="text-uppercase">Dec</h3>
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
@endsection
@section('footer-scripts')
@endsection

<script>
    function billing_folders(month){
        let data = new FormData();
        data.append('_token', '{{csrf_token()}}');
        data.append('month', month)
        data.append('year', $('#year').val())
        let a = function () {
        };
        let arr=[a];
        call_ajax_div_with_functions('billing_folders_div','{{route('billing_folders')}}',data,arr);
    }
    function create_billing_folders(){
        let data = new FormData($('#billing_folders_id')[0]);
        let a = function () {
            billing_folders(data.get('month'));
        };
        let arr=[a];
        call_ajax_div_with_functions('','{{route('create_billing_folders')}}',data,arr);
    }
    function billing_documents(day,month){
        let data = new FormData();
        data.append('_token', '{{csrf_token()}}');
        data.append('day', day)
        data.append('month', month)
        data.append('year', $('#year').val())
        let a = function () {
        };
        let arr=[a];
        call_ajax_div_with_functions('billing_folders_div','{{route('billing_documents')}}',data,arr);
    }
    function create_billing_documents(){
        let data = new FormData($('#billing_documents_id')[0]);
        data.append('year', $('#year').val())
        let a = function () {
            billing_documents(data.get('day'),data.get('month'));
        };
        let arr=[a];
        call_ajax_div_with_functions('','{{route('create_billing_documents')}}',data,arr);
    }
    function delete_document(id){
        let data = new FormData();
        data.append('_token','{{csrf_token()}}')
        data.append('id',id)
        let a = function () {
            billing_documents($('#day_id').val(),$('#month_id').val())
        };
        let arr=[a];
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
                call_ajax_div_with_functions('','{{route('delete_document')}}',data,arr);
            } else {
                Swal.fire("Your Document is safe!");
            }
        });
    }
</script>
