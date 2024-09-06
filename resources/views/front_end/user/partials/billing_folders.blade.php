<div class="">
    <h5 class="text-grey mt-3 mt-lg-0">Hi,<span class="text-seafoam fw-bold mx-2">{{Auth::user()->full_name}}</span></h5>
    <p class="text-grey">Welcome to Atlantis RCM</p>
    <div class="insurance-strip p-2 text-white" style="font-size: 15px;">
        <h5>{{date('F', mktime(0, 0, 0, $month, 10));}}</h5>
    </div>
    <div class="user_dashboad_profilcards">
        <div class="container">

            <a href="{{route('billing_user_dashboard')}}"><i class="fa fa-arrow-left mb-3 text-black-50"></i></a>
        @if(isset($days))
            <div class="row">
                @foreach($days as $day)
                    <div class="pl-3 mt-3">
                        <button onclick="billing_documents({{$day}},{{$month}})" class="btn btn-info"><i class="fa fa-folder-o"></i> {{$day}}</button>
                    </div>
                @endforeach
            </div>
        @endif
        </div>
    </div>
</div>
