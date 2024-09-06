@extends('layout.master')
@section('content')
<!-- 1st section start of revive Home page-->
<section class="first-section-revive  d-flex first-section-content flex-column  justify-content-center" id="home">
    <div class="container">
        <div class="first-section-content text-light">
            <h1 class="font-weight"><b>ReviveE</b> - Your reliable EV Charging Partner.</h1>
            <h2 class="font-weight">Charge Up, Stress Less With <b>ReviveE!</b></h2>
            <p class="w-50 font-weight pt-2">Locate chargers, reserve spots, track your charging sessions,
                and receive updates—all in the palm of your hand.</p>
        </div>
    </div>
</section>
<!-- End of 1st section-->

<!--2nd section start of revive home page Find, Reserve,and Share EV Chargers-->
<section class="second-sec-revive-home-page" id="find">
    <div class="container">

        <div class="div-upper">
            <div class="row  avaliable-app  w-75 m-auto p-3">
                <div class="col-4  d-flex justify-content-center align-items-center h-100">
                    <p class="fs-md-2 ">Available on</p>
                </div>
                <div class="col-4">
                    <a href="">
                        <div class="download-app">
                            <img src="{{asset('public/images/google-play.png')}}" alt="google-play">
                        </div>
                    </a>
                </div>
                <div class="col-4">
                    <a href="">
                        <div class="download-app">
                            <img src="{{asset('public/images/app-store.png')}}" alt="play-store">
                        </div>
                    </a>
                </div>


            </div>
        </div>
        <div class="row my-5">
            <div class="col-md-6">
                <h2 class="fs-2 fw-bold">Find, Reserve,<br>
                    and Share EV Chargers</h2>
                <p class="font-weight pt-3">With only three EV charging ports for every 10,000 people in the US, finding a reliable/affordable station can be challenging. ReviveE is here to change that. We've developed a user-driven platform to combat this scarcity, connecting EV
                    i owners across the US. Our community-based approach not only expands charging options but fosters unity and mutual support.
                </p>
                <p class="font-weight">ReviveE enables chargees to locate, reserve, and even share their own chargers. Our advanced route planning feature incorporates charging stops, optimizing your journey for efficiency and convenience. With ReviveE, hit the road confidently, knowing a reliable charger awaits when needed. Together,
                    we're tackling the charging port scarcity and paving the way for a convenient future.</p>
            </div>
            <div class="col-md-6">
                <div class="location-images">
                    <img src="{{asset('public/images/location-icon.png')}}" class="img-fluid location-img" alt="icon">
                    <img src="{{asset('public/images/mobile-img.png')}}" class="mobile-img" alt="mobile-img">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- section 3 of revive homepage Transform Your EV Charger-->
<section class="third-section-home-revive-page py-5">
    <div class="container">
        <div class="row my-md-5 py-md-5">
            <div class="col-md-6 order-1 order-md-0">
                <img src="{{asset('public/images/mockup-design.png')}}" class="img-fluid" alt="mockup-design-logo">
            </div>
            <div class="col-md-6 p-md-5 order-0 order-md-1">
                <h2 class="fw-bold fs-2">Transform Your EV Charger Into
                    an Asset with ReviveE</h2>
                <p class="font-weight">Did you know your EV charger can generate income? ReviveE provides a user-friendly platform that connects you with Chargees seeking a charging solution, allowing you to maximize the value of your EV charger. You can rent out your charger with confidence, facilitated by our secure and transparent process.
                </p>
                <p class="font-weight">List your charger on ReviveE and help fellow EV enthusiasts conveniently charge their vehicles while earning revenue. It's a win-win situation!</p>

            </div>
        </div>
    </div>
</section>
<!-- section 4 of revive homepage Charge Your EV With Ease-->
<section class="fourth-section-home-revive-page py-md-5" id="mobile">
    <div class="container">
        <div class="row my-md-5 py-md-5">
            <div class="col-md-6 p-md-5 ">
                <h2 class="fw-bold fs-2">Charge Your EV With Ease</h2>
                <p class="font-weight pt-4">Looking for convenient and reliable charging options for your EV? Tired of traveling long distances to reach commercial charging stations? ReviveE seamlessly connects you with nearby Chargers, allowing you to schedule your charging session in advance, ensuring the charger's availability upon arrival, and reducing range anxiety
                </p>
                <p class="font-weight">Say goodbye to limited charging options, high costs, and range anxiety. Plan your charging needs in advance, find reliable charging stations, and save money with ReviveE."</p>

            </div>
            <div class="col-md-6">
                <img src="{{asset('public/images/revive-car.jpg')}}" class="img-fluid" alt="revive-car">
            </div>

        </div>
    </div>
</section>

<!-- section 5 of revive homepage About Us-->
<section class="third-section-home-revive-page py-5" id="about">
    <div class="container">
        <div class="row my-md-5 py-md-5">
            <div class="col-md-6">
                <img src="{{asset('public/images/revive-plug.jpg')}}" class="img-fluid" alt="revive-plug">
            </div>
            <div class="col-md-6 ">
                <h2 class="fw-bold fs-2">About Us</h2>
                <p class="font-weight pt-2">Our story is about pioneering the future of EV charging. ReviveE was created with a vision to bridge the gap between Chargers and Chargees, creating a collaborative ecosystem that promotes resource sharing and fosters a sense of community. As we continue to expand our reach and refine our platform, we remain committed to our core values of innovation, collaboration, and customer focus.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- section 6 of revive homepage Revive Home tabs-->
<section class="section-six-revive-home-tabs py-4 " id="expect">
    <div class="container">
        <div class="row pt-5">
            <div class="col-12">
                <h2 class="fw-bold">Features</h2>
                <p class="font-weight pt-3">Our story is about pioneering the future of EV charging. ReviveE was created with a vision to bridge the gap between Chargers and Chargees, creating a collaborative ecosystem that promotes resource sharing and fosters a sense of
                    community. As we continue to expand our reach and refine our platform, we remain committed to our core values of
                    innovation, collaboration, and customer focus.</p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-4">
                <nav class="nav flex-column nav-pills revive-tab-pills " id="sec2-tabs">
                    <a class="nav-link tab active p-2 text-center font-weight"  data-bs-toggle="pill" href="#tab1">Seamless Connectivity   </a>
                    <a class="nav-link tab mt-3 p-2 text-center font-weight"  data-bs-toggle="pill" href="#tab2">Secure Transactions </a>
                    <a class="nav-link tab mt-3 p-2 text-center font-weight"  data-bs-toggle="pill" href="#tab3">Scheduling Flexibility </a>
                    <a class="nav-link tab mt-3 p-2 text-center font-weight"  data-bs-toggle="pill" href="#tab4">Cost Savings </a>
                    <a class="nav-link tab mt-3 p-2 text-center font-weight"  data-bs-toggle="pill" href="#tab5">Community Support</a>

                </nav>
            </div>
            <div class="col-md-8 my-5 my-lg-0">
                <div class="tab-content ">
                    <div class="tab-pane fade show active" id="tab1">
                        <img src="{{asset('public/images/Seamless-Connectivity.jpg')}}" class="img-fluid" alt="seam-less-connectivity">
                        <p class="tab-para font-weight pt-3">Connect with Chargees or Chargers in your area or along your travel route. Our intuitive interface makes it easy to locate, reserve, and access EV chargers, no matter where you are.</p>
                    </div>
                    <div class="tab-pane fade" id="tab2">
                        <img src="{{asset('public/images/Secure-Transactions.jpg')}}" class="img-fluid" alt="Transactions">
                        <p class="tab-para font-weight pt-3">Connect with Chargees or Chargers in your area or along your travel route. Our intuitive interface makes it easy to locate, reserve, and access EV chargers, no matter where you are.</p>
                    </div>
                    <div class="tab-pane fade" id="tab3">
                        <img src="{{asset('public/images/artboard-21.png')}}" class="img-fluid" alt="artboard">
                        <p class="tab-para font-weight pt-3">Connect with Chargees or Chargers in your area or along your travel route. Our intuitive interface makes it easy to locate, reserve, and access EV chargers, no matter where you are.</p>
                    </div>
                    <div class="tab-pane fade" id="tab4">
                        <img src="{{asset('public/images/Cost-Saving.jpg')}}" class="img-fluid" alt="Saving">
                        <p class="tab-para font-weight pt-3">Connect with Chargees or Chargers in your area or along your travel route. Our intuitive interface makes it easy to locate, reserve, and access EV chargers, no matter where you are.</p>
                    </div>
                    <div class="tab-pane fade" id="tab5">
                        <img src="{{asset('public/images/Community-Support.jpg')}}" class="img-fluid" alt="Support">
                        <p class="tab-para font-weight pt-3">Connect with Chargees or Chargers in your area or along your travel route. Our intuitive interface makes it easy to locate, reserve, and access EV chargers, no matter where you are.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- section 7  How it work of revive homepage -->
<section class="revive-homepage-how-it-work">
    <div class="container">
        <div class="row pt-5">
            <div class="col-12">
                <h2 class="fw-bold">How it Works</h2>
                <p class="font-weight pt-3">ReviveE simplifies the EV charging process into a seamless experience, transforming it from a chore into an opportunity. Whether you're a Charger looking for a convenient charging station or a Chargee wanting to maximize the use of your investment, ReviveE is your go-to platform.</p>
            </div>
        </div>
        <div class="row my-5 pb-5">
            <div class="col-md-4">
                <div class="locate p-5">
                    <p class="text-center fs-6 fw-bold work-heading">Locate & Reserve</p>
                    <p class="font-weight">For Chargees, our platform turns your EV charger into an income source by renting it out to Chargers in need.</p>
                </div>
            </div>
            <div class="col-md-4">

                <div class="locate p-5 mt-5 mt-md-0">
                    <p class="text-center fs-6 fw-bold work-heading ">Plug & Charge</p>
                    <p class="font-weight">With a reserved charging station at your service, all you need to do is arrive and plug in. No more waiting, no more uncertainty. Enjoy a smooth and convenient charging experience.</p>
                </div>
            </div>
            <div class="col-md-4 mt-5 mt-md-0">

                <div class="locate p-5 mt-5 mt-md-0 ">
                    <p class="text-center fs-6 fw-bold work-heading">Earn & Save</p>
                    <p class="font-weight">For Chargees, our platform turns your EV charger into an income source by renting it out to Chargers in need. For Chargers, enjoy cost-effective charging options that save you time and money.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- section 8 Testimonial  of revive homepage -->
<section class="testimonial_sec py-5">
    <div class="container">
        <h2 class="text-center fs-2 fw-bold">Hear From Our Users</h2>
        <div id="carouselExample" class="carousel carousel-dark slide pt-5" data-bs-ride="carousel">
            <div class="carousel-indicators pb-4">
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1" id="crousl_btn"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1"
                        aria-label="Slide 2" id="crousl_btn"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2"
                        aria-label="Slide 3" id="crousl_btn"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="3"
                        aria-label="Slide 4" id="crousl_btn"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="main_testimonial m-auto text-center">
                        <div class="testimonial_img-1">
                            <img src="{{asset('public/images/portrait-overweight-businessman-wearing-suit-isolated-white.png')}}" alt="businessman">
                        </div>
                        <div class="testimonial_content pt-3">
                            <p class="font-weight"> "I used to worry about finding a charging station while on the road. With Revivee, those worries are a thing of the past. Plus, the cost savings have been substantial!" - Thomas
                            </p>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="main_testimonial m-auto text-center">
                        <div class="testimonial_img">
                            <img src="{{asset('public/images/testimonial 1.png')}}">
                        </div>
                        <div class="testimonial_content pt-3">
                            <p class="font-weight"> "I used to worry about finding a charging station while on the road. With ReviveE, those worries are a thing of the past. Plus, the cost savings have been substantial!" - Thomas
                            </p>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="main_testimonial m-auto text-center">
                        <div class="testimonial_img">
                            <img src="{{asset('public/images/testimonial 2.png')}}">
                        </div>
                        <div class="testimonial_content pt-3">
                            <p class="font-weight"> "I used to worry about finding a charging station while on the road. With ReviveE, those worries are a thing of the past. Plus, the cost savings have been substantial!" - Thomas
                            </p>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="main_testimonial m-auto text-center">
                        <div class="testimonial_img">
                            <img src="{{asset('public/images/testimonial 3.png')}}">
                        </div>
                        <div class="testimonial_content pt-3">
                            <p class="font-weight"> "I used to worry about finding a charging station while on the road. With ReviveE, those worries are a thing of the past. Plus, the cost savings have been substantial!" - Thomas
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- section 9  revive homepage Form -->
<section class="section-9-homepage-revive py-5 mt-5">
    <div class="container">
        <div class="row my-3">
            <div class="col-md-6 pt-5">
                <h2 class="fw-bold">Join the ReviveE Community Today!</h2>
                <p class=" font-weight pt-3 form-para">Ready to accelerate into a future where
                    convenience fuels every ride? Join the ReviveE community today and experience the benefits of our innovative platform.
                    Together, we can drive the growth of the EV community and create a greener, more connected world.</p>
            </div>
            <div class="col-md-6 sign-up-today-form p-5 pt-5">
                <div class="">
                    <h2 class="">Sign Up Today</h2>
                    <form>
                        <div class="revive-form-group">
                            <input type="text" id="name" name="name" placeholder="Name" required>
                        </div>
                        <select class="form-select revive-form-group-select" aria-label="Default select example">
                            <option class="choose-service">Choose Services</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <div class="revive-form-group phone-field">
                            <input type="tel" id="phone" name="phone" class="phone-input" placeholder="Choose Details" required>
                            <i class="bi bi-telephone telephone-icon"></i>
                        </div>
                        <div class="revive-form-group">
                            <input type="date" id="date" name="date"  placeholder="Choose Date" required>
                        </div>
                        <div class="revive-form-group">
                            <input type="time" id="time" name="time" placeholder="Choose Time" required>
                        </div>
                        <div>
                            <button type="submit"  class="submit-btn-revive d-block mt-5">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection