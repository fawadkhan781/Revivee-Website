@extends('front_end.layout.main')
@section('header-scripts')
    <link rel="stylesheet" href="{{asset('public/assets/css/credential.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/select2/dist/css/select2.min.css')}}">

    <style>
        /*Start vertical Wizard*/

        .verticalwiz {
            display: block;
            list-style: none;
            position: relative;
            width: 100%
        }

        .verticalwiz a:hover,.verticalwiz a:active,.verticalwiz a:focus {
            text-decoration: none
        }

        .verticalwiz li {
            display: block;
            min-height: 90px;
            max-width: 215px;
            width: 100%;
        }

        .verticalwiz li:before {
            border-top: 3px solid #55606E;
            content: "";
            display: block;
            font-size: 0;
            overflow: auto;
            position: relative;
            top: 10px;
            right: 0;
            width: 100%;
            z-index: 1;
            transform: rotate(90deg) translateY(87px);
            left: 0;
            max-width: 50%;
            margin: 0 auto;
            text-align: center;
        }
        .verticalwiz li.complete .step {
            background: #0aa66e;
            padding: 1px 6px;
            border: 3px solid #55606E
        }

        .verticalwiz li .step i {
            font-size: 10px;
            font-weight: 400;
            position: relative;
            top: -1.5px
        }

        .verticalwiz li .step {
            background: #B2B5B9;
            color: #fff;
            display: inline;
            font-size: 15px;
            font-weight: 700;
            line-height: 12px;
            padding: 7px 13px;
            border: 3px solid transparent;
            border-radius: 50%;
            line-height: normal;
            position: relative;
            text-align: center;
            z-index: 2;
            transition: all .1s linear 0s
        }

        .verticalwiz li.active .step,.verticalwiz li.active.complete .step {
            background: #4CAF50;
            color: #fff;
            font-weight: 700;
            padding: 7px 13px;
            font-size: 15px;
            border-radius: 50%;
            border: 3px solid #7fe583
        }

        .verticalwiz li.complete .title,.verticalwiz li.active .title {
            color: #2B3D53
        }

        .verticalwiz li .title {
            display: inline;
            font-size: 13px;
            position: relative;
            top: 0;
        }

        .rightab {
            border: 1px solid #dedede;
            border-radius: 3px;
            padding: 30px;
            box-shadow: 1px 1px 11px #ccc;
            min-height: 320px;
        }

        @media  (min-width: 992px) and (max-width: 1199px){
            .verticalwiz li:before{
                transform: rotate(90deg) translateY(65px);
                max-width: 60%;
            }
        }
        @media (max-width: 991px){
            .verticalwiz li{
                float: left;
                width: 25%;
                height: auto;
                min-height: inherit;
                margin-bottom: 20px;
                max-width: inherit;
                text-align: center;
            }
            .verticalwiz li:before{
                transform: none;
                max-width: inherit;
                position: absolute;
            }
            .verticalwiz li .title{
                margin-top: 10px;
                text-align: center;
                display: block;
            }
        }
        /*End vertical Wizard*/
    </style>
{{--  Wizard styling  --}}
    <style>
        #timeline.timeline-left .timeline-item > .timeline-badge {
            top:0px !important;
        }
        .gradientpomegranate {
            background-image: linear-gradient(40deg, #150d43, #d76bd2) !important;
            background-repeat: repeat-x !important; }
        .card.status{
            background: rgba(0, 0, 0, 0.09);
        }
        .card-2:active{
            transform:rotate3d(1,1,1,360deg);
            transition: transform 1s;
        }
        .main-content .wizard > .actions > ul > li > a[href="#previous"] {
            background-color: #154546;
        }
        .profile-section .profile-menu {
            padding-left:0px !important;
        }
        .main-content .wizard > .actions {
            display:none;
        }
        #form {
            position: relative;
            margin-top: 20px;
            margin-bottom:20px;
        }
        .finish {
            text-align: center
        }
        .steps_list {
            padding: 35px;
            box-shadow: rgb(0 0 0 / 16%) 0px 1px 4px;
            border-radius: 10px;
        }
        #form fieldset:not(:first-of-type) {
            display: none
        }
        #form .previous-status, .next-status {
            font-weight: bold;
            color: white;
            border: 0 none;
            cursor: pointer;
            padding: 8px 8px;
            margin: 0px 8px 0px 0px;
            float: right;
            border-radius: 3px;
        }
        .form .previous-status {
            background: grey;
        }
        .form .next-status {
            background: #009DA0;
        }
        #form .previous-status:hover,
        #form .previous-status:focus {
            background-color: lightslategrey;
        }
        #form .next-status:hover,
        #form .next-status:focus {
            background-color: #0ae7ea
        }
        .text {
            color: #009DA0;
            font-weight: normal
        }
        #progressbar {
            margin-bottom: -15px;
            overflow: hidden;
            color: lightgrey
        }
        #progressbar .active strong {
            color: var(--seafoam-blue);
        }
        #progressbar strong {
            color: var(--grey);
        }
        #progressbar li {
            list-style-type: none;
            font-size: 14px;
            width: 16.6%;
            float: left;
            position: relative;
            font-weight: 400
        }
        #progressbar #step1:before {
            content: attr(data-title);
        }
        #progressbar #step2:before {
            content: attr(data-title)
        }
        #progressbar #step3:before {
            content: attr(data-title)
        }
        #progressbar #step4:before {
            content: attr(data-title)
        }
        #progressbar #step5:before {
            content:attr(data-title)
        }
        #progressbar #step6:before {
            content: attr(data-title);
        }
        #progressbar li:before {
            width: 106px;
            height: 106px;
            line-height: 42px;
            display: block;
            font-size: 20px;
            color: var(--grey);
            border: 2px solid var(--grey);
            background: lightgray;
            border-radius: 50%;
            padding: 28px;
            z-index: 1;
            box-shadow: rgb(0 0 0 / 10%) 4px 2px 8px;
            padding-left: 45px;

        }
        #progressbar li:after {
            content: '';
            width: 2px;
            height: 80px;
            background: lightgray;
            position: absolute;
            left: 52px;
            top: 45px;
        }
        #progressbar li.active:before,
        #progressbar li.active:after {
            background: #0866E2;
            border: 1px solid #0866E2;
            color: white;
        }
        #progressbar li.visited:before,
        #progressbar li.visited:after {
            background: #B4E4ED;
            border: 1px solid #B4E4ED;
            color: white;
        }

        #progressbar li.active.visited:before{
            background: #B4E4ED;
            border: 2px solid #B4E4ED;

        }
        #progressbar li.bordered:after,
        #progressbar li.bordered:before
         {
            border: 2px solid #0866E2 !important;
            color: white;
        }
        .progress {
            height: 20px
        }
        .progress-bar {
            background-color: #009DA0
        }
        .step_forms_block {
            background-color: #FFFFFF;
            border-radius: 10px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;

        }

        /* Set a style for the submit/register button */
        .Next_btn {
            width: 40%;
            background-color: #cfcfcf;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            font-weight: 600;
            letter-spacing: 1.5px;
            border: none;
            cursor: pointer;
            border-radius: 9px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
        }

        .Next_btn:hover {
            background-color: #40b7ce !important;
            color: white !important;
            transition: all .6s ease-in-out !important;
        }

        /* Add a blue text color to links */

        /*animation form input*/
        .configure_form {
            width:90%;
            height:70px;
            position:relative;
            overflow:hidden;
            margin: 0 auto;
            margin-bottom:10px;
        }
        .configure_form > input{
            width:100%;
            height:100%;
            color:#40b7ce;
            padding-top:25px;
            border:none;
            outline:none;
        }
        .configure_form label {
            position: absolute;
            width:100%;
            height:100%;
            bottom:0px;
            left:0%;
            pointer-events:none;
            border-bottom:1px solid black;
        }
        .configure_form label::after{
            content:"";
            position:absolute;
            width:100%;
            height:100%;
            border-bottom:3px solid #40b7ce;
            bottom:-2px;
            left:0px;
            transform:translateX(-100%);
            transition:all 0.3s ease;
        }
        .content-name{
            font-size: 15px;
            color: #959595;
            position:absolute;
            bottom:5px;
            left:0px;
            transition:all .3s ease;
        }
        .configure_form span.content-name{
            color: #959595 !important;
        }
        .configure_form input:focus+ .label-name .content-name ,
        .configure_form input:valid+ .label-name .content-name{
            transform:translateY(-150%);
            font-size:14px;
            color: #40b7ce !important;
        }
        .configure_form input:focus+ .label-name::after,
        .configure_form input:valid+ .label-name::after {
            transform:translateX(0%);
        }

        #avality_state {
            background-color: var(--bg_blue);
        }
        /*  first step style start */
        a{
            text-decoration: none;
        }
        a:hover{
            text-decoration: none;
        }
        .select-page-card input[type=radio]{
            appearance: none;
            -webkit-appearance: none;
            padding: 123px;
            background-color: #f3f3f3;
            cursor: pointer;
            border: solid 5px #f3f3f3;
            border-radius: 10px;
        }

        #form_type_id1:after{
            content: "Individual Provider";
            text-align: center;
            color: #959595;
        }

        #form_type_id2:after{
            content: "Group Agencies";
            color: #959595;
            font-size: 18px;
        }

        .select-page-card input[type=radio]:checked {
            background-color: #1166e1;
            border: solid 5px #40b7ce;
            color: white;
            border-radius: 10px;
        }

        input[type=radio]#form_type_id1:checked:after ,
        input[type=radio]#form_type_id2:checked:after {
            color: white !important;
        }
        .select_page_button {
            height: 55px;
            background-color: #cfcfcf;
            color: white;
            padding: 16px 80px;
            font-weight: 600;
            letter-spacing: 1.5px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            border-radius: 9px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
        }
        .select_page_button:hover {
            background-color: #40b7ce !important;
            color: white !important;
            transition: all .6s ease-in-out !important;
        }
        .select_page_button a{
            text-decoration: none;
        }
        .select_page_button a:hover{
            text-decoration: none;
        }
        .select_page_button.active{
            background-color: #40b7ce !important;
            color: white !important;
        }
        .label_form3_individual {
            text-align: start;
            width: 90%;
            margin: 0 auto;
        }
        /*  first step style  end */
        .upload-doc {
            width: 90%;
            margin: 12px auto;
        }
        .resume{
            padding: 3px 20px 7px 6px;
            border-radius: 4px;
            background-color: #f0eeee;
        }
        #{
            display: none;
        }
        .choose-a-file {
            background-color: white;
            color: grey;
            padding: 5px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin: 0;
        }
        .upload-button{
            width: 312px;
            height: 44px;
            border-radius: 9px;
            background-color: #1166e1;
        }
        input[type=date] { color: transparent !important; }
        input[type=date]:focus { color: #40b7ce !important; }
        input[type=date]:valid { color: #40b7ce !important; }
        .drop_down_insurances .select2-container--default .select2-selection--single {
            background-color: #1166e1;
            border: 1px solid #1166e1;
            border-radius: 4px;
            height: 100%;
        }
        .drop_down_insurances .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #FFFFFF;
            line-height: 50px;
            text-align: left;
            padding-left: 30px;
        }
        .drop_down_insurances .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #f5f7fa transparent transparent transparent;
        }
        .drop_down_insurances .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 12px;
        }
        .drop_down_insurances .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
            border-color: #e9ecef transparent #f5f7fa transparent;
        }
        .upload-doc .doc_file_uploaded {
            flex-wrap: wrap;
        }
        .upload-doc .doc_file_uploaded div{
        position: relative;
        }
        .upload-doc .doc_file_uploaded i.fa-times-circle{
            position: absolute;
            right: -3px;
            top: -1px;
            color: red;
            background-color: white;
        }
        .ssn_number_check{
            position: absolute;
            right: 48px;
        }
        .providers_checkbox{
            width: 20px;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row {{isset($credential->form_type)?($credential->form_type!=null?'d-none':''):''}} individual" id="first_step_form">
            <div class="col-12">
                <section class="select_the_page d-flex flex-column  justify-content-center align-items-center p-3 my-4" style="background-color: #FFFFFF;">
                    <form action="javascript:step_1_form_submit();" id="step_1_form_id">
                        @csrf
                        <div class="select_the_page_content pt-5">
                            <div class="select_page_description">
                                <h5 class="text-grey text-center">What are you Looking For?</h5>
                                <p class="text-grey text-center pt-4">Please Select the Service as per<br>
                                    your requirements and Click on it</p>
                            </div>
                        </div>
                        <div class="select-page-card d-flex gap-5 pt-5">
                            <div class="form_taxo mx-2">
                                <div class="form-input">
                                    <input type="radio" name="form_type" id="form_type_id1" {{isset($credential->form_type)?($credential->form_type=='credentialing_individual_provider'?'checked':''):''}} value="credentialing_individual_provider" required>
                                </div>
                            </div>
                            <div class="form_taxo mx-2">
                                <div class="form-input">
                                    <input type="radio" name="form_type" id="form_type_id2" {{isset($credential->form_type)?($credential->form_type=='credentialing_agencies'?'checked':''):''}} value="credentialing_agencies" required>
                                </div>
                            </div>
                        </div>
                        <div class="form_submit_btn my-2 d-flex justify-content-center">
                            <button class="select_page_button text-center mt-5 fs-5 btn" type="submit">Next</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
        <input type="hidden" name="credential_id" value="{{isset($credential)?$credential->credential_id:''}}" id="credential_id">
        <div class="row individual step_forms_block {{isset($credential->form_type)?($credential->form_type!==null && $credential->form_type=='credentialing_individual_provider' ?'d-block':'d-none'):'d-none'}}" id="step_forms">
            @include('front_end.user.partials.individual_form')
        </div>
        <div class="row individual step_forms_block {{isset($credential->form_type)?($credential->form_type!==null && $credential->form_type=='credentialing_agencies' ?'d-block':'d-none'):'d-none'}}" id="group_step_forms">
            @include('front_end.user.partials.group_agency')
        </div>
    </div>
    <div class="modal" id="individual_modal" tabindex="-1" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" style="z-index: -1;">
                <div class="modal-header">
                    <h5 class="modal-title">Individual Details</h5>
                    <button type="button" class="btn-close btn-info" style="width:30px"  data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <div id="individual_modal_div"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-scripts')
    <script src="{{asset('public/assets/js/jquery-steps.min.js')}}"></script>
    <script src="{{asset('public/assets/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
{{-- Jquery On ready script --}}
    <script>
        $(document).ready(function(){
            let url=window.location.href.split('/')[3];
            if (url=='view_individual_credential'){
                // For Adding Group
                $('.group_step1').remove();
                $('.group_step2').attr('data-title','1');
                $('.group_step3').attr('data-title','2');
                $('.group_step4').attr('data-title','>');
                // For adding Provider
                let form_type=$('input[name="form_type"]:checked').val();
                if ($('#parent_id').val()!=''){
                    $('#add_new_providers').addClass('d-none')
                    $('#step2').attr('data-title','1');
                    $('#step3').attr('data-title','2');
                    $('#step4').attr('data-title','3');
                    $('#step5').attr('data-title','4');
                    $('#step6').attr('data-title','>');
                    modal_change_steps(2)
                }
                else if(form_type == 'credentialing_agencies')
                {
                    group_change_steps(2)
                }
                else{
                    change_steps(2)
                }
                let step=window.location.href.split('/')[5];
                if (step!=null){
                    $('.step').removeClass('active')
                    $('.step').removeClass('visited')
                    let pre_step=Number(step)-1;
                    if ($('#parent_id').val()!=''){
                        modal_change_steps(step)
                        $('.modal_step'+pre_step).removeClass('visited');
                    }
                    else if(form_type=='credentialing_agencies')
                    {
                        group_change_steps(step)
                        $('.group_step'+pre_step).removeClass('visited');
                    }
                    else{
                        change_steps(step)
                        $('#step'+pre_step).removeClass('visited');
                    }
                }
            }
            @if(isset($form_type))
            if ({{$form_type=='credentialing_agencies'}}) {
                group_show_step_forms()
            } else {
                show_step_forms()
            }
            @endif
            $('.select2').select2({
                // dropdownParent: $('#individual_modal')
            });
            $(".icons-tab-steps").steps({
                headerTag: "h6",
                bodyTag: "fieldset",
                transitionEffect: "fade",
                titleTemplate: '<span class="step">#index#</span> #title#',
                labels: {
                    finish: 'Submit'
                },
                onFinished: function (event, currentIndex) {
                    alert("Form submitted.");
                }
            });
            $('input[name="form_type"]').click(function(){
                $('.select_page_button').addClass('active');
            });
            $('.ssn_number_check').click(function(){
                if($('.ssn_number').attr('type')=='text'){
                    $('.ssn_number').attr('type','password')
                    $('.eye').addClass('fa-eye-slash').removeClass('fa-eye')
                }else{
                    $('.ssn_number').attr('type','text')
                    $('.eye').addClass('fa-eye').removeClass('fa-eye-slash')
                }
            });
            // modal check ssn Number
            $(document).on('click','#ssn_number_check',function(){
                if($('.modal_ssn_number').attr('type')=='text'){
                    $('.modal_ssn_number').attr('type','password')
                    $('.modal_eye').addClass('fa-eye-slash').removeClass('fa-eye')
                }else{
                    $('.modal_ssn_number').attr('type','text')
                    $('.modal_eye').addClass('fa-eye').removeClass('fa-eye-slash')
                }
            });
            // individual Document Upload Image Names
            $('#billing_address').click(function(){
                if($(this).prop("checked") == true){
                    $('#billing_mailing_address').val($('#service_address').val())
                }else{
                    $('#billing_mailing_address').val('')
                }
            });
            $(document).on('click','#group_billing_address',function(){
                if($(this).prop("checked") == true){
                    $('#group_billing_mailing_address').val($('#group_service_address').val())
                }else{
                    $('#group_billing_mailing_address').val('')
                }
            });
            $(document).on('click','#modal_billing_address',function(){
                if($(this).prop("checked") == true){
                    $('#modal_billing_mailing_address').val($('#modal_service_address').val())
                }else{
                    $('#modal_billing_mailing_address').val('')
                }
            });
            $('#state_license_image').change(function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#state_license_image_name').text(fileName)
            });
            $('#accreditation_image').change(function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#accreditation_image_name').text(fileName)
            });
            $('#irs_letter_image').change(function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#irs_letter_image_name').text(fileName)
            });
            $('#professional_liability_insurance_image').change(function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#professional_liability_insurance_image_name').text(fileName)
            });
            $('#bank_letter_image').change(function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#bank_letter_image_name').text(fileName)
            });
            $('#driver_license_image').change(function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#driver_license_image_name').text(fileName)
            });
            $('#w9_form_image').change(function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#w9_form_image_name').text(fileName)
            });
            $('#resume_image').change(function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#resume_image_name').text(fileName)
            });
            $('#degree_image').change(function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#degree_image_name').text(fileName)
            });
            $('#additional_document_image').change(function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#additional_document_image_name').text(fileName)
            });
            $('#board_certification_image').change(function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#board_certification_image_name').text(fileName)
            });

            // Group Document Upload Image Names
            $('#group_state_license_image').change(function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#group_state_license_image_name').text(fileName)
            });
            $('#group_accreditation_image').change(function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#group_accreditation_image_name').text(fileName)
            });
            $('#group_irs_letter_image').change(function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#group_irs_letter_image_name').text(fileName)
            });
            $('#group_professional_liability_insurance_image').change(function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#group_professional_liability_insurance_image_name').text(fileName)
            });
            $('#group_bank_letter_image').change(function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#group_bank_letter_image_name').text(fileName)
            });
            $('#group_driver_license_image').change(function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#group_driver_license_image_name').text(fileName)
            });
            $('#group_w9_form_image').change(function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#group_w9_form_image_name').text(fileName)
            });
            $('#group_resume_image').change(function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#group_resume_image_name').text(fileName)
            });
            $('#group_degree_image').change(function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#group_degree_image_name').text(fileName)
            });
            $('#group_additional_document_image').change(function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#group_additional_document_image_name').text(fileName)
            });
            $('#group_voided_cheque_image').change(function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#group_voided_cheque_image_name').text(fileName)
            });

            // Modal Document Upload Image Names
            $(document).on('change','#modal_state_license_image',function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#modal_state_license_image_name').text(fileName)
            });
            $(document).on('change','#modal_accreditation_image',function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#modal_accreditation_image_name').text(fileName)
            });
            $(document).on('change','#modal_irs_letter_image',function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#modal_irs_letter_image_name').text(fileName)
            });
            $(document).on('change','#modal_professional_liability_insurance_image',function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#modal_professional_liability_insurance_image_name').text(fileName)
            });
            $(document).on('change','#modal_bank_letter_image',function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#modal_bank_letter_image_name').text(fileName)
            });
            $(document).on('change','#modal_driver_license_image',function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#modal_driver_license_image_name').text(fileName)
            });
            $(document).on('change','#modal_w9_form_image',function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#modal_w9_form_image_name').text(fileName)
            });
            $(document).on('change','#modal_resume_image',function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#modal_resume_image_name').text(fileName)
            });
            $(document).on('change','#modal_degree_image',function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#modal_degree_image_name').text(fileName)
            });
            $(document).on('change','#modal_additional_document_image',function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#modal_additional_document_image_name').text(fileName)
            });
            $(document).on('change','#modal_board_certification_image',function(e){
                let fileName='';
                if (e.target.files.length > 1){
                     fileName = e.target.files.length+' Files';
                }else{
                     fileName = e.target.files[0].name;
                }
                $('#modal_board_certification_image_name').text(fileName)
            });
            $('#step2_submit').click(function(){
               $('#group_name').removeAttr('required')
               $('#group_npi').removeAttr('required')
               $('#medicare_id').removeAttr('required')
               $('#medicare_start_date').removeAttr('required')
            });
            $('#group_step2_submit').click(function(){
               $('#group_medicare_id').removeAttr('required')
            });
            $(document).on('click','#modal_step2_submit',function(){
                $('#modal_group_name').removeAttr('required')
                $('#modal_group_npi').removeAttr('required')
                $('#modal_medicare_id').removeAttr('required')
                $('#modal_medicare_start_date').removeAttr('required')
            });
        });
    </script>
{{--   Individudal Step Form Functions--}}
    <script>
        function change_steps(step){
            let pre_step = step-1;
            $('.step'+pre_step).addClass('visited')
            $('.step'+step).addClass('active')
            $('fieldset').removeClass('d-block')
            $('fieldset').addClass('d-none')
            $('#fieldset_step'+step).removeClass('d-none')
            $('#fieldset_step'+step).addClass('d-block')
            if ($('.step'+step).hasClass('visited')){
                $('.step.active').addClass('visited')
                $('#step'+step).removeClass('visited')
            }
        }

        function show_step_forms(){
            $('#step_forms').removeClass('d-none')
            $('#step_forms').addClass('d-block')
            $('#first_step_form').addClass('d-none')
            $('#first_step_form').removeClass('d-block')
            change_steps(2)

        }
        function back_change_steps(step){
            let pre_step = step+1;
            if (pre_step==1 && $('#step'+pre_step).hasClass('visited')){
                $('fieldset').removeClass('d-block')
                $('fieldset').addClass('d-none')
                $('#step_forms').removeClass('d-block')
                $('#step_forms').addClass('d-none')
                $('#group_step_forms').removeClass('d-block')
                $('#group_step_forms').addClass('d-none')
                $('#first_step_form').removeClass('d-none')
                $('#first_step_form').addClass('d-block')
            }else{
                if ($('#step'+pre_step).hasClass('active')){
                    $('.step.active').addClass('visited')
                    $('#step'+pre_step).removeClass('visited')
                    $('fieldset').removeClass('d-block')
                    $('fieldset').addClass('d-none')
                    $('#fieldset_step'+pre_step).removeClass('d-none')
                    $('#fieldset_step'+pre_step).addClass('d-block')
                }
            }

        }
        function step_1_form_submit() {
            if ($("#form_type_id1").prop("checked")) {
                show_step_forms()
            } else {
                group_show_step_forms()
            }
        }
        function step_2_form_submit(){
            let data = new FormData($('#step_2_form_id')[0]);
            data.append('credential_id',$('#credential_id').val())
            let request=new XMLHttpRequest();
            request.open('POST','{{route('step_2_form_submit')}}',true)
            request.send(data)
            request.onreadystatechange=function(){
                if(request.readyState==4){
                    json = JSON.parse(request.responseText);
                    if(json.status.toLowerCase()=="success") {
                        $('#credential_id').val(json.credential_id)
                        let step=window.location.href.split('/')[5];
                        if (step!=null){
                            window.location.href='{{route('user_dashboard')}}'
                        }
                        change_steps(3);
                    }
                }
            }
        }
        function step_3_form_submit(){
            let data = new FormData($('#step_3_form_id')[0]);
            data.append('credential_id',$('#credential_id').val())
            let a = function () {
                let step=window.location.href.split('/')[5];
                if (step!=null){
                    window.location.href='{{route('user_dashboard')}}'
                }
                change_steps(4);
            };
            let arr = [a];
            call_ajax_with_functions('', '{{route('step_3_form_submit')}}', data, arr);
        }
        function step_4_form_submit(){
            let data = new FormData($('#step_4_form_id')[0]);
            data.append('credential_id',$('#credential_id').val())
            let a = function () {
                change_steps(5);
            };
            let arr = [a];
            call_ajax_with_functions('', '{{route('step_4_form_submit')}}', data, arr);
        }
        function step_5_form_submit(){
            let data = new FormData($('#step_5_form_id')[0]);
            data.append('credential_id',$('#credential_id').val())
            let a = function () {
                change_steps(6);
                setTimeout(function () {
                    window.location.href= '{{route('user_dashboard')}}'
                }, 1000);
            };
            let arr = [a];
            call_ajax_with_functions('', '{{route('step_5_form_submit')}}', data, arr);
        }

        function add_more_insurance(row) {
            let id=$(row).children(":selected").attr("id")
            let name=$(row).children(":selected").text();
            $(row).children(":selected").remove();
            $('#insurance_list').prepend('<div class="input-group pl-1" id="row_insurance_'+id+'"><input type="hidden" name="insurances[]" id="" value="'+id+'" class="form-control mt-3"><input type="text" disabled id="insurance_id_'+id+'" value="'+name+'" class="form-control h-auto mt-3"><div class="input-group-append"><button class="btn btn btn-light border mt-3" title="Remove extra" type="button" id="'+id+'" onclick="remove_insurance(this)"> <i class="fa fa-times font-19 pt-1"></i></button></div></div>')
        }
        function remove_insurance(e) {
            let rowid = $(e).attr('id')
            let name = $('#insurance_id_'+rowid).val();
            $('#row_insurance_' + rowid).remove()
            $('#insurance_id').append('<option value="'+rowid+'" id="'+rowid+'">'+name+'</option>')
        }
    </script>
{{--    Group Step Form Functions--}}
    <script>
        function group_show_step_forms(){
            $('#group_step_forms').removeClass('d-none')
            $('#group_step_forms').addClass('d-block')
            $('#first_step_form').addClass('d-none')
            $('#first_step_form').removeClass('d-block')
            group_change_steps(2)
        }
        function group_change_steps(step){
            let pre_step = step-1;
            $('.group_step'+pre_step).addClass('visited')
            $('.group_step'+step).addClass('active')
            $('fieldset').removeClass('d-block')
            $('fieldset').addClass('d-none')
            $('#group_fieldset_step'+step).removeClass('d-none')
            $('#group_fieldset_step'+step).addClass('d-block')
            if ($('.group_step'+step).hasClass('visited')){
                $('.step.active').addClass('visited')
                $('.group_step'+step).removeClass('visited')
            }
        }
        function group_back_change_steps(step){
            let pre_step = step+1;
            if (pre_step==1 && $('.group_step'+pre_step).hasClass('visited')){
                $('fieldset').removeClass('d-block')
                $('fieldset').addClass('d-none')
                $('#step_forms').removeClass('d-block')
                $('#step_forms').addClass('d-none')
                $('#group_step_forms').removeClass('d-block')
                $('#group_step_forms').addClass('d-none')
                $('#first_step_form').removeClass('d-none')
                $('#first_step_form').addClass('d-block')
            }else{
                if ($('.group_step'+pre_step).hasClass('visited')||$('.group_step'+pre_step).hasClass('active')){
                    $('.step.active').addClass('visited')
                    $('.group_step'+pre_step).removeClass('visited')
                    $('fieldset').removeClass('d-block')
                    $('fieldset').addClass('d-none')
                    $('#group_fieldset_step'+pre_step).removeClass('d-none')
                    $('#group_fieldset_step'+pre_step).addClass('d-block')
                }
            }

        }
        function group_step_2_form_submit(){
            let data = new FormData($('#group_step_2_form_id')[0]);
            data.append('credential_id',$('#credential_id').val())
            let request=new XMLHttpRequest();
            request.open('POST','{{route('step_2_form_submit')}}',true)
            request.send(data)
            request.onreadystatechange=function(){
                if(request.readyState==4){
                    json = JSON.parse(request.responseText);
                    if(json.status.toLowerCase()=="success") {
                        $('#credential_id').val(json.credential_id)
                        let step=window.location.href;
                        let pathurl=new URL(step).pathname.split('/')[3]
                        if (pathurl==2){
                            window.location.href='{{route('group_dashboard')}}'
                        }
                        group_change_steps(3);
                    }
                }
            }
        }
        function group_step_5_form_submit(){
            let data = new FormData($('#group_step_5_form_id')[0]);
            data.append('credential_id',$('#credential_id').val())
            let a = function () {
                let step=window.location.href;
                let pathurl=new URL(step).pathname.split('/')[3]
                if (pathurl==3){
                    window.location.href='{{route('group_dashboard')}}'
                }
                group_change_steps(4);
            };
            let arr = [a];
            call_ajax_with_functions('', '{{route('step_5_form_submit')}}', data, arr);
        }
        function group_add_more_insurance(row) {
            let id=$(row).children(":selected").attr("id")
            let name=$(row).children(":selected").text();
            $(row).children(":selected").remove();
            $('#group_insurance_list').prepend('<div class="input-group pl-1" id="group_row_insurance_'+id+'"><input type="hidden" name="insurances[]" id="" value="'+id+'" class="form-control mt-3"><input type="text" disabled id="group_insurance_id_'+id+'" value="'+name+'" class="form-control h-auto mt-3"><div class="input-group-append"><button class="btn btn btn-light border mt-3" title="Remove extra" type="button" id="'+id+'" onclick="group_remove_insurance(this)"> <i class="fa fa-times font-19 pt-1"></i></button></div></div>')
        }
        function group_remove_insurance(e) {
            let rowid = $(e).attr('id')
            let name = $('#group_insurance_id_'+rowid).val();
            $('#group_row_insurance_' + rowid).remove()
            $('#group_insurance_id').append('<option value="'+rowid+'" id="'+rowid+'">'+name+'</option>')
        }
        $("input[name='provider_credential_id[]']").click(function(){
            $('#add_providers').removeClass('d-none')
        });
        function add_previous_provider(){
            let data=new FormData($('#previous_provider_id')[0])
                data.append('parent_id',$('#credential_id').val())
            let a = function () {
                $("input[name='provider_credential_id[]']:checked").parent('div').addClass('d-none')
                $("input[name='provider_credential_id[]']:checked").parent('div').removeClass('d-flex')
                $('input[name="provider_credential_id[]"]').prop("checked", false);
                $('#add_providers').addClass('d-none')
            };
            let arr = [a];
            call_ajax_div_with_functions('', '{{route('add_previous_provider')}}', data, arr);
        }
    </script>
{{--    modal Step Form Functions--}}
    <script>
        function modal_change_steps(step){
            let pre_step = step-1;
            $('.modal_step'+pre_step).addClass('visited')
            $('.modal_step'+step).addClass('active')
            $('fieldset').removeClass('d-block')
            $('fieldset').addClass('d-none')
            $('#modal_fieldset_step'+step).removeClass('d-none')
            $('#modal_fieldset_step'+step).addClass('d-block')
            $('#group_fieldset_step4').removeClass('d-none')
            $('#group_fieldset_step4').addClass('d-block')
            if ($('.modal_step'+step).hasClass('visited')){
                $('.step.active').addClass('visited')
                $('.modal_step'+step).removeClass('visited')
            }
        }
        function modal_back_change_steps(step) {
            let pre_step = step + 1;
            if ($('.modal_step' + pre_step).hasClass('visited') || $('.modal_step' + pre_step).hasClass('active')) {
                $('.step.active').addClass('visited')
                $('.modal_step'+pre_step).removeClass('visited')
                $('fieldset').removeClass('d-block')
                $('fieldset').addClass('d-none')
                $('#modal_fieldset_step' + pre_step).removeClass('d-none')
                $('#modal_fieldset_step' + pre_step).addClass('d-block')
            }
        }
        function individual_form_modal(id){
            let data = new FormData();
            data.append('id',$('#credential_id').val())
            data.append('_token','{{csrf_token()}}')
            let a = function () {
                modal_change_steps(2)
                $('#individual_modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#individual_modal').modal('show')
                $.fn.modal.Constructor.prototype._enforceFocus = function() {};
                $('.modal_select').select2({
                    dropdownParent: $('#individual_modal'),
                    dropdownPosition: 'below'
                });
                $('.modal_step2').attr('data-title','1');
                $('.modal_step3').attr('data-title','2');
                $('.modal_step4').attr('data-title','3');
                $('.modal_step5').attr('data-title','4');
                $('.modal_step6').attr('data-title','>');
            };
            let arr = [a];
            call_ajax_with_functions('individual_modal_div', '{{route('individual_form_modal')}}', data, arr);
        }
        function modal_step_2_form_submit(){
            let data = new FormData($('#modal_step_2_form_id')[0]);
            let a = function () {
                let step=window.location.href;
                let pathurl=new URL(step).pathname.split('/')[3]
                if (pathurl==2){
                    window.location.href='{{route('group_dashboard')}}'
                }
                modal_change_steps(3);
            };
            let arr = [a];
            call_ajax_with_functions('', '{{route('step_2_form_submit')}}', data, arr);
        }
        function modal_step_3_form_submit(){
            let data = new FormData($('#modal_step_3_form_id')[0]);
            let a = function () {
                let step=window.location.href;
                let pathurl=new URL(step).pathname.split('/')[3]
                if (pathurl==3){
                    window.location.href='{{route('group_dashboard')}}'
                }
                modal_change_steps(4);
            };
            let arr = [a];
            call_ajax_with_functions('', '{{route('step_3_form_submit')}}', data, arr);
        }
        function modal_step_4_form_submit(){
            let data = new FormData($('#modal_step_4_form_id')[0]);
            let a = function () {
                modal_change_steps(5);
            };
            let arr = [a];
            call_ajax_with_functions('', '{{route('step_4_form_submit')}}', data, arr);
        }
        function modal_step_5_form_submit(){
            let data = new FormData($('#modal_step_5_form_id')[0]);
            let a = function () {
                let step=window.location.href;
                let pathurl=new URL(step).pathname.split('/')[3]
                if (pathurl==5){
                    window.location.href='{{route('group_dashboard')}}'
                }
                modal_change_steps(6);
            };
            let arr = [a];
            call_ajax_with_functions('', '{{route('step_5_form_submit')}}', data, arr);
        }
        function modal_add_more_insurance(row) {
            let id=$(row).children(":selected").attr("id")
            let name=$(row).children(":selected").text();
            $(row).children(":selected").remove();
            $('#modal_insurance_list').prepend('<div class="input-group pl-1" id="modal_row_insurance_'+id+'"><input type="hidden" name="insurances[]" id="" value="'+id+'" class="form-control mt-3"><input type="text" disabled id="modal_insurance_id_'+id+'" value="'+name+'" class="form-control h-auto mt-3"><div class="input-group-append"><button class="btn btn btn-light border mt-3" title="Remove extra" type="button" id="'+id+'" onclick="modal_remove_insurance(this)"> <i class="fa fa-times font-19 pt-1"></i></button></div></div>')
        }
        function modal_remove_insurance(e) {
            let rowid = $(e).attr('id')
            let name = $('#modal_insurance_id_'+rowid).val();
            $('#modal_row_insurance_' + rowid).remove()
            $('#modal_insurance_id').append('<option value="'+rowid+'" id="'+rowid+'">'+name+'</option>')
        }
    </script>
{{--    Document Remove Functions--}}
    <script>
        function remove_state_license_image(image) {
            document.getElementById("old_state_license_img" + image).classList.add("d-none");
            document.getElementById("old_state_license_image_" + image).remove();
        }
        function remove_accreditation_image(image) {
            document.getElementById("old_accreditation_img" + image).classList.add("d-none");
            document.getElementById("old_accreditation_image_" + image).remove();
        }

        function remove_irs_letter_image(image) {
            document.getElementById("old_irs_letter_img" + image).classList.add("d-none");
            document.getElementById("old_irs_letter_image_" + image).remove();
        }

        function remove_bank_letter_image(image) {
            document.getElementById("old_bank_letter_img" + image).classList.add("d-none");
            document.getElementById("old_bank_letter_image_" + image).remove();
        }

        function remove_professional_liability_insurance_image(image) {
            document.getElementById("old_professional_liability_insurance_img" + image).classList.add("d-none");
            document.getElementById("old_professional_liability_insurance_image_" + image).remove();
        }

        function remove_driver_license_image_image(image) {
            document.getElementById("old_driver_license_img" + image).classList.add("d-none");
            document.getElementById("old_driver_license_image_" + image).remove();
        }

        function remove_w9_form_image(image) {
            document.getElementById("old_w9_form_img" + image).classList.add("d-none");
            document.getElementById("old_w9_form_image_" + image).remove();
        }
        function remove_resume_image(image) {
            document.getElementById("old_resume_img" + image).classList.add("d-none");
            document.getElementById("old_resume_image_" + image).remove();
        }
        function remove_degree_image(image) {
            document.getElementById("old_degree_img" + image).classList.add("d-none");
            document.getElementById("old_degree_image_" + image).remove();
        }
        function remove_board_certification_image(image) {
            document.getElementById("old_board_certification_img" + image).classList.add("d-none");
            document.getElementById("old_board_certification_image_" + image).remove();
        }
        function remove_additional_document_image(image) {
            document.getElementById("old_additional_document_img" + image).classList.add("d-none");
            document.getElementById("old_additional_document_image_" + image).remove();
        }

    //     group documents Remove
        function group_remove_state_license_image(image) {
            document.getElementById("group_old_state_license_img" + image).classList.add("d-none");
            document.getElementById("group_old_state_license_image_" + image).remove();
        }
        function group_remove_accreditation_image(image) {
            document.getElementById("group_old_accreditation_img" + image).classList.add("d-none");
            document.getElementById("group_old_accreditation_image_" + image).remove();
        }

        function group_remove_irs_letter_image(image) {
            document.getElementById("group_old_irs_letter_img" + image).classList.add("d-none");
            document.getElementById("group_old_irs_letter_image_" + image).remove();
        }

        function group_remove_bank_letter_image(image) {
            document.getElementById("group_old_bank_letter_img" + image).classList.add("d-none");
            document.getElementById("group_old_bank_letter_image_" + image).remove();
        }

        function group_remove_professional_liability_insurance_image(image) {
            document.getElementById("group_old_professional_liability_insurance_img" + image).classList.add("d-none");
            document.getElementById("group_old_professional_liability_insurance_image_" + image).remove();
        }

        function group_remove_driver_license_image_image(image) {
            document.getElementById("group_old_driver_license_img" + image).classList.add("d-none");
            document.getElementById("group_old_driver_license_image_" + image).remove();
        }

        function group_remove_w9_form_image(image) {
            document.getElementById("group_old_w9_form_img" + image).classList.add("d-none");
            document.getElementById("group_old_w9_form_image_" + image).remove();
        }
        function group_remove_voided_cheque_image(image) {
            document.getElementById("group_old_voided_cheque_img" + image).classList.add("d-none");
            document.getElementById("group_old_voided_cheque_image_" + image).remove();
        }
        function group_remove_resume_image(image) {
            document.getElementById("group_old_resume_img" + image).classList.add("d-none");
            document.getElementById("group_old_resume_image_" + image).remove();
        }
        function group_remove_degree_image(image) {
            document.getElementById("group_old_degree_img" + image).classList.add("d-none");
            document.getElementById("group_old_degree_image_" + image).remove();
        }

        function group_remove_additional_document_image(image) {
            document.getElementById("group_old_additional_document_img" + image).classList.add("d-none");
            document.getElementById("group_old_additional_document_image_" + image).remove();
        }
    </script>
@endsection
