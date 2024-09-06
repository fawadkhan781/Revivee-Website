<!DOCTYPE html>
<html lang="en">

<head>
    <!-- MEta tags-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- Faviicon link-->
    <Link rel="Icon" type="image/png" href="{{asset('public/images/Svg Revive Icon.svg')}}">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
          integrity="sha512-d7W8mAXuL0gd+amTc9r/BnCVDXsJG3Yon5v5q1Zu+ILq0QKii0oU0oqLsbj3CRg53UQ7fGkt9+pGzcum5NB6Q=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--Bootstrap link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!--Bootstrap Icon Link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Fontawsome Link-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&family=Montserrat:wght@300;400;500;700&family=Roboto:wght@100&family=Rubik&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Rubik&display=swap" rel="stylesheet">
    <!-- My own css link-->
    <link rel="stylesheet" href="{{asset('public/css/revive.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/responsive.css')}}">
    <!-- Website Title-->
    <title>ReviveE</title>
</head>
<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="75">
<!--Navbar section Start-->
<header class="header_wrapper mb-5">
    <nav class="navbar navbar-expand-lg   fixed-top " style="background-color: #5c5c5c !important;">
        <div class="container">
            <a class="navbar-brand revive-logo fs-2 fst-italic" href="/">
                <img src="{{asset('public/images/logo-revivee.png')}}" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                <!--<span class="navbar-toggler-icon"></span>-->
                <i class="fas fa-stream navbar-toggler-icon navbar-stream-icon"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav  mb-2 mb-lg-0 menu-navbar-nav justify-content-evenly">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="{{route('index')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('index')}}">Find a Location</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('index')}}">Mobile App</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('index')}}">About ReviveE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('index')}}">What to Expect</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!--Navbar section Exit-->
<section style="margin-top: 150px;">
    <div class="container">
        <h1>Privacy Policy</h1>
        <p>This Privacy Policy describes how Revivee LLC ("we," "us," or "our") collects, uses, and shares information collected from users ("you" or "your") of our mobile application Revivee (the "App").</p>
        <p><strong><strong>Information We Collect</strong></strong></p>
        <p>We may collect the following types of information when you use our App:</p>
        <ul>
            <li><strong><strong>Personal Information:</strong></strong>When you create an account, we may collect personal information such as your name, email address, and phone number.</li>
            <li><strong><strong>Charger Information:</strong></strong>If you are a charger owner, we may collect information about your charger, such as its location,picture of charger,and&nbsp;availability</li>
            <li><strong><strong>Booking Information:</strong></strong>When you book a charging session, we may collect information about the time slot you selected and the duration of your booking.</li>
            <li><strong><strong>Payment Information:</strong></strong>When you make a payment through the App, we may collect payment information such as your credit card details or other payment method information.</li>
            <li><strong><strong>Usage Information:</strong></strong>We may collect information about how you use the App, such as the features you use, the pages you visit, and the actions you take.</li>
            <li><strong><strong>Device Information:</strong></strong>We may collect information about your mobile device, including its model, operating system version, unique device identifiers, and mobile network information.</li>
        </ul>
        <p><strong><strong>How We Use Your Information</strong></strong></p>
        <p>We may use the information we collect for the following purposes:</p>
        <ul>
            <li>To provide and improve the App and its features;</li>
            <li>To facilitate bookings and payments for charging sessions;</li>
            <li>To communicate with you about your account, bookings, and other relevant information;</li>
            <li>To personalize your experience and offer tailored content;</li>
            <li>To monitor and analyze trends, usage, and activities in connection with the App; and</li>
            <li>To comply with legal requirements and enforce our policies.</li>
        </ul>
        <p><strong><strong>Sharing of Your Information</strong></strong></p>
        <p>We may share your information with third parties for the following purposes:</p>
        <ul>
            <li>With charger owners to facilitate bookings and payments for charging sessions;</li>
            <li>With service providers who help us operate the App and provide related services;</li>
            <li>With law enforcement or other third parties in response to legal requests or to protect our rights, property, or safety, or the rights, property, or safety of others; and</li>
            <li>In connection with a merger, acquisition, or sale of all or a portion of our assets.</li>
        </ul>
        <p><strong><strong>Your Choices</strong></strong></p>
        <p>You may choose not to provide certain information, but this may limit your ability to use certain features of the App. You can also update or delete your account information at any time.</p>
        <p><strong><strong>Security</strong></strong></p>
        <p>We take reasonable measures to protect the information we collect from loss, theft, misuse, and unauthorized access, disclosure, alteration, and destruction.</p>
        <p><strong><strong>Changes to this Privacy Policy</strong></strong></p>
        <p>We may update this Privacy Policy from time to time. If we make material changes, we will notify you by posting the updated policy on this page.</p>
        <p><strong><strong>Contact Us</strong></strong></p>
        <p>If you have any questions about this Privacy Policy, please contact us at info@revivee.com.</p>
        <p>&nbsp;</p>
    </div>
</section>
<!-- Footer Revive copyrightline-->
@include('layout.footer')
<!-- Bootstrap Jquery Link-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<!-- type js cdn link-->
<script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>
</body>
</html>
