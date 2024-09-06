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
    <link rel="stylesheet" href="{{asset('/public/assets/css/bootstrap.min.css')}}">
    <!--Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/css/custom.css')}}">
</head>
<body style="height:100vh; background-image: url({{asset('public/assets/images/login/login-page-bg.webp')}});">
<!--page start-->
<div class="container h-100">
    <div class="d-flex h-100 flex-column justify-content-center align-items-center">
        <div class="card">
            <div class="card-content">
                <div class="card-body text-center">
                    <div>
                        <img src="{{asset('public/assets/images/login/logo-rcm.png')}}" style="    width: 200px;height: 35px;margin-bottom: 20px;margin-top: 7px;" alt="">
                        <p class="card-text">
                            Welcome to Atlantis Revenue Cycle Management
                        </p>
                        <label class="font-weight-bold mb-2">Enter your Credentials</label>
                        <form id="login_form" action="javascript:login();" class="mt-2 mx-2">
                            @csrf
                            <div class="position-relative has-icon-left">
                                <input type="email" class="form-control login_form mb-3" placeholder="Email Address" name="email" autocomplete="off" />
                                <div class="form-control-position ml-1">
                                    <img src="{{asset('public/assets/images/login/icon-user.webp')}}" style="width: 15px; height: 15px;margin-bottom: 7px;" alt="">
                                </div>
                            </div>
                            <div class="position-relative has-icon-left">
                                <input type="password" class="form-control login_form mb-3" placeholder="Password" name="password" />
                                <div class="form-control-position ml-1">
                                    <img src="{{asset('public/assets/images/login/icon-password.webp')}}" style="width: 25px;height: 15px;" alt="">
                                </div>
                            </div>
                            <button class="btn btn-block " type="submit">
                                <a id="m_login_signin_submit" class="text-decoration-none text-white">Login</a>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <p class="text-white font-weight-bold mt-4 mb-1 text-center">Need Help? <a href="#"style="text-decoration: underline; color: #00cae8;">Contact Our Customer Support</a></p>
        <p class="text-white text-center">Visit Our Website: <span class="font-weight-bold">www.atlantisrcm.com</span></p>
    </div>
</div>
<!-- Javascript -->
<script src="{{asset('/public/assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('/public/assets/js/ajax.js')}}"></script>
<script src="{{asset('/public/assets/js/sweetalert2.js')}}"></script>
<script>
    function login() {
        let data = new FormData($('#login_form')[0]);
        let a = function () {
            window.location.reload();
        };
        let arr = [a];
        call_ajax_with_functions('', '{{route('do_login')}}', data, arr);
    }
</script>
</body>
</html>
