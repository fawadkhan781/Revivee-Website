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
@include('layout.header')
<!--Navbar section Exit-->
@yield('content')
<!-- Footer Revive copyrightline-->
@include('layout.footer')
<!-- Bootstrap Jquery Link-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<!-- type js cdn link-->
<script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>
<script>
    // Tab javascript code.

    document.addEventListener("DOMContentLoaded", function() {
        // Set the initial active tab
        var activeTab = 0;

        // Interval for tab switching (in milliseconds)
        var interval = 3000; // Change tabs every 3 seconds

        // Function to change the active tab
        function changeTab() {
            var tabs = document.querySelectorAll(".revive-tab-pills a");
            var tabCount = tabs.length;
            activeTab = (activeTab + 1) % tabCount; // Cycle through tabs
            tabs[activeTab].click(); // Simulate a click on the tab
        }

        // Start the tab switching interval
        var tabInterval = setInterval(changeTab, interval);

        // Pause tab switching when mouse enters the tab area
        var tabPills = document.querySelector(".revive-tab-pills");
        tabPills.addEventListener("mouseenter", function() {
            clearInterval(tabInterval);
        });

        // Resume tab switching when mouse leaves the tab area
        tabPills.addEventListener("mouseleave", function() {
            tabInterval = setInterval(changeTab, interval);
        });
    });
    // header scroll
    let  nav=document.querySelector(".navbar");
    window.onscroll=function () {
        if(document.documentElement.scrollTop>70){
            nav.classList.add("header-scrolled");
        }else {
            nav.classList.remove("header-scrolled");
        }
    }
    //nav-hide
    let navBar=document.querySelectorAll(".nav-link");
    let navCollapase=document.querySelector(".navbar-collapse.collapse");
    navBar.forEach(function (a){
        a.addEventListener("click",function (){
            navCollapase.classList.remove("show")
        })
    })</script>
</body>
</html>
