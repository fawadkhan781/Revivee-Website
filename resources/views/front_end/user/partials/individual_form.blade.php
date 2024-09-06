<div class="col" id="form">
    <div class="row p-5">
        <div class="col-lg-5">
            <div class="steps_list">
                <ul id="progressbar" class="d-flex flex-column">
                    @if(!isset($credential->parent_id))
                        <li class="d-flex w-100 my-2 align-items-center active visited step" onclick="back_change_steps(0)"  id="step1" data-title="1">
                            <strong class="mx-4" >Select Option</strong>
                        </li>
                    @endif
                    <li id="step2" onclick="{{isset($credential->parent_id)?'modal_':''}}back_change_steps(1)" class="d-flex w-100 my-2 align-items-center step {{isset($credential->parent_id)?'modal_':''}}step2 @if(isset($credential)) @if($credential->form_type!=null && $credential->ein_tin==null)   active  @elseif($credential->ein_tin!=null && $credential->form_type!=null) visited active @else ''  @endif @endif" data-title="2">
                        <strong class="mx-4" >Individual Details</strong>
                    </li>
                    <li id="step3" onclick="{{isset($credential->parent_id)?'modal_':''}}back_change_steps(2)" class="d-flex w-100 my-2 align-items-center step {{isset($credential->parent_id)?'modal_':''}}step3 @if(isset($credential)) @if($credential->ein_tin!=null && $credential->logins==null)   active  @elseif($credential->ein_tin!=null && $credential->logins!=null) visited active @else ''  @endif @endif" data-title="3">
                        <strong class="mx-4" >Logins</strong>
                    </li>
                    <li id="step4" onclick="{{isset($credential->parent_id)?'modal_':''}}back_change_steps(3)" class="d-flex w-100 my-2 align-items-center step {{isset($credential->parent_id)?'modal_':''}}step4 @if(isset($credential)) @if($credential->logins!=null && count($credential->insurances)==0)   active  @elseif($credential->logins!=null && count($credential->insurances)>0) visited active @else ''  @endif @endif" data-title="4">
                        <strong class="mx-4" >Insurances List</strong>
                    </li>
                    <li id="step5" onclick="{{isset($credential->parent_id)?'modal_':''}}back_change_steps(4)" class="d-flex w-100 my-2 align-items-center step {{isset($credential->parent_id)?'modal_':''}}step5 @if(isset($credential)) @if(count($credential->insurances)>0 && $credential->credential_documents==null)   active  @elseif(count($credential->insurances)!=0 && $credential->credential_documents!=null) visited active @else ''  @endif @endif" data-title="5">
                        <strong class="mx-4" >Document Upload</strong>
                    </li>
                    <li id="step6" onclick="{{isset($credential->parent_id)?'modal_':''}}back_change_steps(5)" class="d-flex w-100 my-2 align-items-center step {{isset($credential->parent_id)?'modal_':''}}step6 @if(isset($credential)) @if($credential->credential_documents!==null) active  @else ''  @endif @endif" data-title=">">
                        <strong class="mx-4" >Success</strong>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-7 p-3" style="background-color: #ffffff !important;">
            <h2 class="fw-bold my-2 d-none pt-3 text-center text-grey">Configure your RCM Account</h2>
            <fieldset class="" id="{{isset($credential->parent_id)?'modal_':''}}fieldset_step1">
            </fieldset>
            @php
                $show = false; $hide = false;
                    if(isset($credential)){if($credential->form_type!==null && $credential->ein_tin==null){$show = true; $hide = false;} else {$show = false; $hide = true;}}
            @endphp
            <fieldset id="{{isset($credential->parent_id)?'modal_':''}}fieldset_step2" @class(['d-block' => $show, 'd-none'=>$hide])>
                <div class="">
                    <div class="form_login">
                        <form action="javascript:{{isset($credential->parent_id)?'modal_':''}}step_2_form_submit();" id="{{isset($credential->parent_id)?'modal_':''}}step_2_form_id" class="">
                            <h4 class="py-1 text-grey text-center">Individual Details</h4>
                            @csrf
                        @if(isset($credential->parent_id))
                                <input type="hidden" name="credential_id" value="{{isset($credential)?$credential->credential_id:''}}">
                            @endif
                            <input type="hidden" name="form_type" value="credentialing_individual_provider">
                            <div class="configure_form">
                                <input type="text" name="provider_name" value="{{isset($credential->provider_name)?($credential->provider_name):''}}" required  autocomplete="off" >
                                <label for="name" class="label-name">
                                    <span class="content-name">Provider Name <span class="text-info">*</span>
                                    @if(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->provider_name==1)
                                            <span><i class="fa fa-check-circle text-success"></i></span>
                                    @elseif(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->provider_name==2)
                                            <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->credential_statuses->provider_name_message}}</span>
                                    @else
                                    @endif
                                    </span>
                                </label>
                            </div>
                            <div class="configure_form">
                                <input type="text" name="provider_npi" value="{{isset($credential->provider_npi)?($credential->provider_npi):''}}" required autocomplete="off" >
                                <label for="name" class="label-name">
                                    <span class="content-name">Provider Npi <span class="text-info">*</span>
                                    @if(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->provider_npi==1)
                                            <span><i class="fa fa-check-circle text-success"></i></span>
                                        @elseif(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->provider_npi==2)
                                            <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->credential_statuses->provider_npi_message}}</span>
                                        @else
                                        @endif
                                    </span>
                                </label>
                            </div>
                            <div class="configure_form">
                                <input type="text" id="{{isset($credential->parent_id)?'modal_':''}}group_name" name="group_name" value="{{isset($credential->group_name)?($credential->group_name):''}}" required autocomplete="off" >
                                <label for="name" class="label-name">
                                    <span class="content-name">Group Name
                                     @if(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->group_name==1)
                                            <span><i class="fa fa-check-circle text-success"></i></span>
                                        @elseif(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->group_name==2)
                                            <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->credential_statuses->group_name_message}}</span>
                                        @else
                                        @endif
                                    </span>
                                </label>
                            </div>
                            <div class="configure_form">
                                <input type="text" id="{{isset($credential->parent_id)?'modal_':''}}group_npi" name="group_npi" value="{{isset($credential->group_npi)?($credential->group_npi):''}}" required autocomplete="off">
                                <label for="name" class="label-name">
                                    <span class="content-name">Group NPI
                                     @if(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->group_npi==1)
                                            <span><i class="fa fa-check-circle text-success"></i></span>
                                        @elseif(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->group_npi==2)
                                            <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->credential_statuses->group_npi_message}}</span>
                                        @else
                                        @endif
                                    </span>
                                </label>
                            </div>
                            <div class="configure_form">
                                <input type="text" name="legal_name" value="{{isset($credential->legal_name)?($credential->legal_name):''}}" required autocomplete="off">
                                <label for="name" class="label-name">
                                    <span class="content-name">Legal Name on IRS Letter <span class="text-info">*</span>
                                     @if(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->legal_name==1)
                                            <span><i class="fa fa-check-circle text-success"></i></span>
                                        @elseif(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->legal_name==2)
                                            <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->credential_statuses->legal_name_message}}</span>
                                        @else
                                        @endif
                                    </span>
                                </label>
                            </div>
                            <div class="configure_form">
                                <input type="text" name="ein_tin" value="{{isset($credential->ein_tin)?($credential->ein_tin):''}}" required autocomplete="off">
                                <label for="name" class="label-name">
                                    <span class="content-name">EIN/TIN <span class="text-info">*</span>
                                     @if(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->ein_tin==1)
                                            <span><i class="fa fa-check-circle text-success"></i></span>
                                        @elseif(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->ein_tin==2)
                                            <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->credential_statuses->ein_tin_message}}</span>
                                        @else
                                        @endif
                                    </span>
                                </label>
                            </div>
                            <div class="configure_form">
                                <input type="password" class="{{isset($credential->parent_id)?'modal_':''}}ssn_number" name="ssn_number" value="{{isset($credential->ssn_number)?($credential->ssn_number):''}}" required autocomplete="off">
                                <label for="name" class="label-name">
                                    <span class="content-name">Social Security No. <span class="text-info">*</span>
                                     @if(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->ssn_number==1)
                                            <span><i class="fa fa-check-circle text-success"></i></span>
                                        @elseif(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->ssn_number==2)
                                            <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->credential_statuses->ssn_number_message}}</span>
                                        @else
                                        @endif
                                    </span>
                                </label>
                            </div>
                            <span class="mt-n5 ssn_number_check" id="ssn_number_check"><i class="fa {{isset($credential->parent_id)?'modal_':''}}eye fa-eye-slash"></i></span>
                            <div class="configure_form">
                                <input type="date" name="owner_dob" value="{{isset($credential->owner_dob)?($credential->owner_dob):''}}" required autocomplete="off">
                                <label for="name" class="label-name">
                                    <span class="content-name">D.O.B <span class="text-info">*</span>
                                     @if(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->owner_dob==1)
                                            <span><i class="fa fa-check-circle text-success"></i></span>
                                        @elseif(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->owner_dob==2)
                                            <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->credential_statuses->owner_dob_message}}</span>
                                        @else
                                        @endif
                                    </span>
                                </label>
                            </div>
                            <div class="configure_form">
                                <input type="text" name="service_address" id="{{isset($credential->parent_id)?'modal_':''}}service_address" value="{{isset($credential->service_address)?($credential->service_address):''}}" required autocomplete="off">
                                <label for="name" class="label-name">
                                    <span class="content-name">Service Address <span class="text-info">*</span>
                                     @if(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->service_address==1)
                                            <span><i class="fa fa-check-circle text-success"></i></span>
                                        @elseif(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->service_address==2)
                                            <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->credential_statuses->service_address_message}}</span>
                                        @else
                                        @endif
                                    </span>
                                </label>
                            </div>
                            <div class="d-flex align-items-center" style="width: 90%; margin: auto">
                                <input type="hidden" name="check_address" value="0">
                                <input type="checkbox" name="check_address" class="d-block" {{isset($credential->check_address)?($credential->check_address==1?'checked':''):''}} title="Billing address same as Service address" value="1" id="{{isset($credential->parent_id)?'modal_':''}}billing_address"></span>
                                <p class="text-grey m-0 mx-1" style="font-size: 13px;">Billing Address same as Service Address*</p>
                            </div>
                            <div class="configure_form" >
                                <input type="text" name="billing_mailing_address" id="{{isset($credential->parent_id)?'modal_':''}}billing_mailing_address" value="{{isset($credential->billing_mailing_address)?($credential->billing_mailing_address):''}}" required autocomplete="off">
                                <label for="name" class="label-name">
                                    <span class="content-name">Billing Address <span class="text-info">*</span>
                                     @if(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->billing_mailing_address==1)
                                            <span><i class="fa fa-check-circle text-success"></i></span>
                                        @elseif(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->billing_mailing_address==2)
                                            <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->credential_statuses->billing_mailing_address_message}}</span>
                                        @else
                                        @endif
                                    </span>
                                </label>
                            </div>
                            <div class="configure_form">
                                <input type="text" id="{{isset($credential->parent_id)?'modal_':''}}medicare_id" name="medicare_id" value="{{isset($credential->medicare_id)?($credential->medicare_id):''}}" required autocomplete="off">
                                <label for="name" class="label-name">
                                    <span class="content-name">Medicare Id
                                     @if(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->medicare_id==1)
                                            <span><i class="fa fa-check-circle text-success"></i></span>
                                        @elseif(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->medicare_id==2)
                                            <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->credential_statuses->medicare_id_message}}</span>
                                        @else
                                        @endif
                                    </span>
                                </label>
                            </div>

                            <div class="configure_form">
                                <input type="date" id="{{isset($credential->parent_id)?'modal_':''}}medicare_start_date" name="start_date" value="{{isset($credential->start_date)?($credential->start_date):''}}" required  autocomplete="off">
                                <label for="name" class="label-name">
                                    <span class="content-name">Medicare Start Date
                                     @if(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->start_date==1)
                                            <span><i class="fa fa-check-circle text-success"></i></span>
                                        @elseif(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->start_date==2)
                                            <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->credential_statuses->start_date_message}}</span>
                                        @else
                                        @endif
                                    </span>
                                </label>
                            </div>
                            <div class="d-flex justify-content-center my-3 w-100">
                                <button type="submit" class="Next_btn" id="{{isset($credential->parent_id)?'modal_':''}}step2_submit">Next</button>
                            </div>
                        </form>
                    </div>
                </div>
            </fieldset>
            @php
                if(isset($credential)){if($credential->ein_tin!==null && $credential->logins==null){$show = true; $hide = false;} else {$show = false; $hide = true;}}
            @endphp
            <fieldset  id="{{isset($credential->parent_id)?'modal_':''}}fieldset_step3" @class(['d-block' => $show, 'd-none'=>$hide])">
            <div class="">
                <div class="form_login">
                    <form action="javascript:{{isset($credential->parent_id)?'modal_':''}}step_3_form_submit();" id="{{isset($credential->parent_id)?'modal_':''}}step_3_form_id" class="">
                        <h4 class="py-1 text-grey text-center">Logins</h4>
                        @csrf
                        <input type="hidden" name="credential_id" value="{{ isset($credential)?$credential->credential_id:''}}">
                        <p class="text-grey label_form3_individual font-weight-bold">CAQH  Logins</p>
                        <div class="configure_form">
                            <input type="text" name="caqh_username" value="{{isset($credential->logins->caqh_username)?($credential->logins->caqh_username):''}}" required autocomplete="off">
                            <label for="name" class="label-name">
                                <span class="content-name">User Name <span class="text-info">*</span>
                                @if(isset($credential) && $credential->login_statuses!=null && $credential->login_statuses->caqh_username==1)
                                        <span><i class="fa fa-check-circle text-success"></i></span>
                                    @elseif(isset($credential) && $credential->login_statuses!=null && $credential->login_statuses->caqh_username==2)
                                        <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->login_statuses->caqh_username_message}}</span>
                                    @else
                                    @endif
                                </span>
                            </label>
                        </div>
                        <div class="configure_form">
                            <input type="text" name="caqh_password"  value="{{isset($credential->logins->caqh_password)?($credential->logins->caqh_password):''}}" required autocomplete="off">
                            <label for="name" class="label-name">
                                <span class="content-name">Password <span class="text-info">*</span>
                                @if(isset($credential) && $credential->login_statuses!=null && $credential->login_statuses->caqh_password==1)
                                        <span><i class="fa fa-check-circle text-success"></i></span>
                                    @elseif(isset($credential) && $credential->login_statuses!=null && $credential->login_statuses->caqh_password==2)
                                        <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->login_statuses->caqh_password_message}}</span>
                                    @else
                                    @endif
                                </span>
                            </label>
                        </div>
                        <p class="text-grey label_form3_individual mt-5 font-weight-bold">NPPES/PECOS Logins</p>
                        <div class="configure_form">
                            <input type="text" name="nppes_username" value="{{isset($credential->logins->nppes_username)?($credential->logins->nppes_username):''}}" required autocomplete="off">
                            <label for="name" class="label-name">
                                <span class="content-name">User Name <span class="text-info">*</span>
                                @if(isset($credential) && $credential->login_statuses!=null && $credential->login_statuses->nppes_username==1)
                                        <span><i class="fa fa-check-circle text-success"></i></span>
                                    @elseif(isset($credential) && $credential->login_statuses!=null && $credential->login_statuses->nppes_username==2)
                                        <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->login_statuses->nppes_username_message}}</span>
                                    @else
                                    @endif
                                </span>
                            </label>
                        </div>
                        <div class="configure_form">
                            <input type="text" name="nppes_password" value="{{isset($credential->logins->nppes_password)?($credential->logins->nppes_password):''}}" required autocomplete="off">
                            <label for="name" class="label-name">
                                <span class="content-name">Password <span class="text-info">*</span>
                                @if(isset($credential) && $credential->login_statuses!=null && $credential->login_statuses->nppes_password==1)
                                        <span><i class="fa fa-check-circle text-success"></i></span>
                                    @elseif(isset($credential) && $credential->login_statuses!=null && $credential->login_statuses->nppes_password==2)
                                        <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->login_statuses->nppes_password_message}}</span>
                                    @else
                                    @endif
                                </span>
                            </label>
                        </div>
                        <p class="text-grey label_form3_individual mt-5 font-weight-bold">Provider Logins</p>
                        <div class="configure_form">
                            <input type="text" name="provider_username" value="{{isset($credential->logins->provider_source_username)?($credential->logins->provider_source_username):''}}" autocomplete="off">
                            <label for="name" class="label-name">
                                <span class="content-name">User Name
                                @if(isset($credential) && $credential->login_statuses!=null && $credential->login_statuses->provider_source_username==1)
                                        <span><i class="fa fa-check-circle text-success"></i></span>
                                    @elseif(isset($credential) && $credential->login_statuses!=null && $credential->login_statuses->provider_source_username==2)
                                        <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->login_statuses->provider_source_username_message}}</span>
                                    @else
                                    @endif
                                </span>
                            </label>
                        </div>
                        <div class="configure_form">
                            <input type="text" name="provider_password" value="{{isset($credential->logins->provider_source_password)?($credential->logins->provider_source_password):''}}" autocomplete="off">
                            <label for="name" class="label-name">
                                <span class="content-name">Password 
                                @if(isset($credential) && $credential->login_statuses!=null && $credential->login_statuses->provider_source_password==1)
                                        <span><i class="fa fa-check-circle text-success"></i></span>
                                    @elseif(isset($credential) && $credential->login_statuses!=null && $credential->login_statuses->provider_source_password==2)
                                        <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->login_statuses->provider_source_password_message}}</span>
                                    @else
                                    @endif
                                </span>
                            </label>
                        </div>
                        <p class="text-grey label_form3_individual mt-5 mb-2 font-weight-bold">Availity Logins</p>
                        @if(isset($credential) && $credential->login_statuses!=null && $credential->login_statuses->availity_state==1)
                            <span><i class="fa fa-check-circle text-success ml-4"></i></span>
                        @elseif(isset($credential) && $credential->login_statuses!=null && $credential->login_statuses->availity_state==2)
                            <span class="text-danger ml-4"><i class="fa fa-times-circle mr-1"></i> {{$credential->login_statuses->availity_state_message}}</span>
                        @else
                        @endif
                        <div class="configure_form h-100">
                            <select name="availity_state" id="avality_state" class="form-control" required style="color: #ffffff;">
                                <option value="">Select State</option>
                                @php $states=array("Alabama", "Alaska", "Arizona", "Arkansas", "California",
                                    "Colorado", "Connecticut", "Delaware", "Florida", "Georgia", "Hawaii", "Idaho",
                                    "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland",
                                    "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska",
                                    "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Carolina", "North Dakota",
                                    "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee",
                                    "Texas", "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming");
                                @endphp
                                @foreach($states as $state)
                                    <option value="{{$state}}" {{isset($credential->logins->availity_state)?($credential->logins->availity_state==$state?'selected':''):''}}>
                                        {{$state}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="configure_form">
                            <input type="text" name="availity_username" value="{{isset($credential->logins->availity_username)?($credential->logins->availity_username):''}}" required autocomplete="off">
                            <label for="name" class="label-name">
                                <span class="content-name">User Name <span class="text-info">*</span>
                                @if(isset($credential) && $credential->login_statuses!=null && $credential->login_statuses->availity_username==1)
                                        <span><i class="fa fa-check-circle text-success"></i></span>
                                    @elseif(isset($credential) && $credential->login_statuses!=null && $credential->login_statuses->availity_username==2)
                                        <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->login_statuses->availity_username_message}}</span>
                                    @else
                                    @endif
                                </span>
                            </label>
                        </div>
                        <div class="configure_form">
                            <input type="text" name="availity_password" value="{{isset($credential->logins->availity_password)?($credential->logins->availity_password):''}}" required autocomplete="off">
                            <label for="name" class="label-name">
                                <span class="content-name">Password <span class="text-info">*</span>
                                @if(isset($credential) && $credential->login_statuses!=null && $credential->login_statuses->availity_password==1)
                                        <span><i class="fa fa-check-circle text-success"></i></span>
                                    @elseif(isset($credential) && $credential->login_statuses!=null && $credential->login_statuses->availity_password==2)
                                        <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->login_statuses->availity_password_message}}</span>
                                    @else
                                    @endif
                                </span>
                            </label>
                        </div>
                        <div class="d-flex justify-content-center my-3 w-100">
                            <button type="submit" class="Next_btn">Next</button>
                        </div>
                    </form>
                </div>
            </div>
            </fieldset>
            @php
                if(isset($credential)){if($credential->logins!==null && count($credential->insurances)==0){$show = true; $hide = false;} else {$show = false; $hide = true;}}
            @endphp
            <fieldset  id="{{isset($credential->parent_id)?'modal_':''}}fieldset_step4" @class(['d-block' => $show, 'd-none'=>$hide])">
            <form action="javascript:{{isset($credential->parent_id)?'modal_':''}}step_4_form_submit();" id="{{isset($credential->parent_id)?'modal_':''}}step_4_form_id" class="">
                <h4 class="py-1 text-grey text-center">Insurances List</h4>
                @csrf
                <input type="hidden" name="credential_id" value="{{isset($credential)?$credential->credential_id:''}}">
                <div class="row px-4">
                    <div class="col-12 mb-3">
                        <div class="drop_down_insurances">
                            <label class="font-weight-bold text-grey mt-3" for="insurance">Insurances: <span class="text-info">*</span></label>
                            <select name="insurance" id="{{isset($credential->parent_id)?'modal_':''}}insurance_id" class="form-control {{isset($credential->parent_id)?'modal_select':''}} select2" style="width:100%;" onchange="{{isset($credential->parent_id)?'modal_':''}}add_more_insurance(this)">
                                <option value="">Select Below</option>
                                @foreach($insurance_list as $insurance)
                                    <option value="{{$insurance->id}}" id="{{$insurance->id}}">{{$insurance->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12" id="{{isset($credential->parent_id)?'modal_':''}}insurance_list">
                    </div>
                    @if(isset($user_insurances->insurances))
                        <div class="col-12">
                            @foreach($user_insurances->insurances as $insurance)
                                <div class="input-group pl-1" id="{{isset($credential->parent_id)?'modal_':''}}row_insurance_{{$insurance->id}}">
                                    <input type="hidden" name="insurances[]" id="" value="{{$insurance->id}}" class="form-control mt-3">
                                    <input type="text" disabled id="{{isset($credential->parent_id)?'modal_':''}}insurance_id_{{$insurance->id}}" value="{{$insurance->title}}" class="form-control h-auto mt-3" style="color: #959595; padding-left: 20px;">
                                    <div class="input-group-append">
                                        <button class="btn btn-light border mt-3"style="" title="Remove extra" type="button" id="{{$insurance->id}}" onclick="{{isset($credential->parent_id)?'modal_':''}}remove_insurance(this)">
                                            <i class="fa fa-times font-19 pt-1"></i></button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="d-flex justify-content-center my-3 w-100">
                    <button type="submit" class="Next_btn">Next</button>
                </div>
            </form>
            </fieldset>
            @php
                if(isset($credential)){if(count($credential->insurances)!=0 && $credential->credential_documents==null){$show = true; $hide = false;} else {$show = false; $hide = true;}}
            @endphp
            <fieldset  id="{{isset($credential->parent_id)?'modal_':''}}fieldset_step5"  @class(['d-block' => $show, 'd-none'=>$hide])>
                <form action="javascript:{{isset($credential->parent_id)?'modal_':''}}step_5_form_submit();" id="{{isset($credential->parent_id)?'modal_':''}}step_5_form_id" class="">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        @csrf
                        <input type="hidden" name="credential_id" value="{{isset($credential)?$credential->credential_id:''}}">
                        <h4 class="py-1 text-grey text-center">Upload Documents</h4>

                        <div class="upload-doc">
                            <div class="">
                                @if(isset($credential) && $credential->document_status!=null && $credential->document_status->state_license_image==1)
                                    <span><i class="fa fa-check-circle text-success"></i></span>
                                @elseif(isset($credential) && $credential->document_status!=null && $credential->document_status->state_license_image==2)
                                    <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->document_status->state_license_image_message}}</span>
                                @else
                                @endif
                            </div>
                            <div class="align-items-center d-flex justify-content-between p-2 resume">
                                <div class="w-100">
                                    <label for="{{isset($credential->parent_id)?'modal_':''}}state_license_image" class="choose-a-file"><input accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" id="{{isset($credential->parent_id)?'modal_':''}}state_license_image" class="d-none" name="state_license_image[]" type="file" multiple value="" placeholder="" >Choose File</label> <span id="{{isset($credential->parent_id)?'modal_':''}}state_license_image_name"></span>
                                </div>
                                <p class="m-0 resume_content text-right text-grey w-75">State License</p>
                            </div>
                            <div class="d-flex doc_file_uploaded">
                                @php $stateimg_cnt=0; @endphp
                                @if(isset($credential) && $credential->credential_documents && $credential->credential_documents->state_license_image !=null)
                                    @foreach(explode(',',$credential->credential_documents->state_license_image)  as $img_index => $image)
                                        <div class="btn_pos"
                                             id="old_state_license_img{{$img_index}}">
                                            <a class="btn btn-sm btn-outline-info m-1"
                                               download
                                               href="{{asset('public/credential_images/'.$image)}}">
                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                File<span class=""></span></a>
                                            <i class="fa fa-times-circle"
                                               onclick="remove_state_license_image({{$img_index}})"
                                               title="Remove File"></i>
                                        </div>
                                        <input type="hidden"
                                               name="old_state_license_image[{{$img_index}}]"
                                               value="{{$image}}"
                                               id="old_state_license_image_{{$img_index}}"
                                               class="">
                                        @php $stateimg_cnt ++; @endphp
                                    @endforeach
                                @endif
                                <input type="hidden" name="stateimg_name"
                                       id="stateimg_cnt"
                                       value="<?php echo $stateimg_cnt;?>">
                            </div>
                        </div>
                        <div class="upload-doc">
                            <div class="">
                                @if(isset($credential) && $credential->document_status!=null && $credential->document_status->accreditation_image==1)
                                    <span><i class="fa fa-check-circle text-success"></i></span>
                                @elseif(isset($credential) && $credential->document_status!=null && $credential->document_status->accreditation_image==2)
                                    <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->document_status->accreditation_image_message}}</span>
                                @else
                                @endif
                            </div>
                            <div class="align-items-center d-flex justify-content-between p-2 resume">
                                <div class="w-100">
                                    <label for="{{isset($credential->parent_id)?'modal_':''}}accreditation_image" class="choose-a-file"><input accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" id="{{isset($credential->parent_id)?'modal_':''}}accreditation_image" class="d-none" name="accreditation_image[]" type="file" multiple value="" placeholder="" >Choose File</label> <span id="{{isset($credential->parent_id)?'modal_':''}}accreditation_image_name"></span>
                                </div>
                                <p class="m-0 resume_content text-right text-grey w-75">Accreditation</p>
                            </div>
                            <div class="d-flex doc_file_uploaded">
                                @php $credentialimg_cnt =0; @endphp
                                @if(isset($credential) && $credential->credential_documents && $credential->credential_documents->accreditation_image !=null)
                                    @foreach(explode(',',$credential->credential_documents->accreditation_image)  as $img_index => $image)
                                        <div class="btn_pos"
                                             id="old_accreditation_img{{$img_index}}">
                                            <a class="btn btn-sm btn-outline-info m-1"
                                               download
                                               href="{{asset('public/credential_images/'.$image)}}">
                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                File<span class=""></span></a>
                                            <i class="fa fa-times-circle"
                                               onclick="remove_accreditation_image({{$img_index}})"
                                               title="Remove File"></i>
                                        </div>
                                        <input type="hidden"
                                               name="old_accreditation_image[{{$img_index}}]"
                                               value="{{$image}}"
                                               id="old_accreditation_image_{{$img_index}}"
                                               class="">
                                        @php $credentialimg_cnt ++; @endphp
                                    @endforeach
                                @endif
                                <input type="hidden" name="credentialimg_cnt"
                                       id="credentialimg_cnt"
                                       value="<?php echo $credentialimg_cnt;?>">
                            </div>
                        </div>

                        <div class="upload-doc {{isset($credential) && $credential->parent_id!=null?'d-none':''}}">
                            <div class="">
                                @if(isset($credential) && $credential->document_status!=null && $credential->document_status->irs_letter_image==1)
                                    <span><i class="fa fa-check-circle text-success"></i></span>
                                @elseif(isset($credential) && $credential->document_status!=null && $credential->document_status->irs_letter_image==2)
                                    <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->document_status->irs_letter_image_message}}</span>
                                @else
                                @endif
                            </div>
                            <div class="align-items-center d-flex justify-content-between p-2 resume">
                                <div class="w-100">
                                    <label for="{{isset($credential->parent_id)?'modal_':''}}irs_letter_image" class="choose-a-file"><input accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" id="{{isset($credential->parent_id)?'modal_':''}}irs_letter_image" class="d-none" name="irs_letter_image[]" type="file" multiple value="" placeholder="" >Choose File</label> <span id="{{isset($credential->parent_id)?'modal_':''}}irs_letter_image_name"></span>
                                </div>
                                <p class="m-0 resume_content text-right text-grey w-75">IRS Letter</p>
                            </div>
                            <div class="d-flex doc_file_uploaded">
                                @php $irsimg_cnt=0; @endphp
                                @if(isset($credential) && $credential->credential_documents && $credential->credential_documents->irs_letter_image !=null)
                                    @foreach(explode(',',$credential->credential_documents->irs_letter_image)  as $img_index => $image)
                                        <div class="btn_pos"
                                             id="old_irs_letter_img{{$img_index}}">
                                            <a class="btn btn-sm btn-outline-info m-1"
                                               download
                                               href="{{asset('public/credential_images/'.$image)}}">
                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                File<span class=""></span></a>
                                            <i class="fa fa-times-circle"
                                               onclick="remove_irs_letter_image({{$img_index}})"
                                               title="Remove File"></i>
                                        </div>
                                        <input type="hidden"
                                               name="old_irs_letter_image[{{$img_index}}]"
                                               value="{{$image}}"
                                               id="old_irs_letter_image_{{$img_index}}"
                                               class="">
                                        @php $irsimg_cnt ++; @endphp
                                    @endforeach
                                @endif
                                <input type="hidden" name="irsimg_cnt" id="irsimg_cnt"
                                       value="<?php echo $irsimg_cnt;?>">
                            </div>
                        </div>
                        <div class="upload-doc {{isset($credential) && $credential->parent_id!=null?'d-none':''}}">
                            <div class="">
                                @if(isset($credential) && $credential->document_status!=null && $credential->document_status->professional_liability_insurance_image==1)
                                    <span><i class="fa fa-check-circle text-success"></i></span>
                                @elseif(isset($credential) && $credential->document_status!=null && $credential->document_status->professional_liability_insurance_image==2)
                                    <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->document_status->professional_liability_insurance_image_message}}</span>
                                @else
                                @endif
                            </div>
                            <div class="align-items-center d-flex justify-content-between p-2 resume">
                                <div class="w-100">
                                    <label for="{{isset($credential->parent_id)?'modal_':''}}professional_liability_insurance_image" class="choose-a-file"><input accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" id="{{isset($credential->parent_id)?'modal_':''}}professional_liability_insurance_image" class="d-none" name="professional_liability_insurance_image[]" type="file" multiple value="" placeholder="" >Choose File</label> <span id="{{isset($credential->parent_id)?'modal_':''}}professional_liability_insurance_image_name"></span>
                                </div>
                                <p class="m-0 resume_content text-right text-grey w-75">Professional Liability Insurance/MalPractise</p>
                            </div>
                            <div class="d-flex doc_file_uploaded">
                                @php $professionalimg_cnt =0; @endphp
                                @if(isset($credential) && $credential->credential_documents && $credential->credential_documents->professional_liability_insurance_image !=null)
                                    @foreach(explode(',',$credential->credential_documents->professional_liability_insurance_image)  as $img_index => $image)
                                        <div class="btn_pos"
                                             id="old_professional_liability_insurance_img{{$img_index}}">
                                            <a class="btn btn-sm btn-outline-info m-1"
                                               download
                                               href="{{asset('public/credential_images/'.$image)}}">
                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                File<span class=""></span></a>
                                            <i class="fa fa-times-circle"
                                               onclick="remove_professional_liability_insurance_image({{$img_index}})"
                                               title="Remove File"></i>
                                        </div>
                                        <input type="hidden"
                                               name="old_professional_liability_insurance_image[{{$img_index}}]"
                                               value="{{$image}}"
                                               id="old_professional_liability_insurance_image_{{$img_index}}"
                                               class="">
                                        @php $professionalimg_cnt ++; @endphp
                                    @endforeach
                                @endif
                                <input type="hidden" name="professionalimg_cnt"
                                       id="professionalimg_cnt"
                                       value="<?php echo $professionalimg_cnt;?>">
                            </div>
                        </div>
                        <div class="upload-doc {{isset($credential) && $credential->parent_id!=null?'d-none':''}}">
                            <div class="">
                                @if(isset($credential) && $credential->document_status!=null && $credential->document_status->bank_letter_image==1)
                                    <span><i class="fa fa-check-circle text-success"></i></span>
                                @elseif(isset($credential) && $credential->document_status!=null && $credential->document_status->bank_letter_image==2)
                                    <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->document_status->bank_letter_image_message}}</span>
                                @else
                                @endif
                            </div>
                            <div class="align-items-center d-flex justify-content-between p-2 resume">
                                <div class="w-100">
                                    <label for="{{isset($credential->parent_id)?'modal_':''}}bank_letter_image" class="choose-a-file"><input accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" id="{{isset($credential->parent_id)?'modal_':''}}bank_letter_image" class="d-none" name="bank_letter_image[]" type="file" multiple value="" placeholder="" >Choose File</label> <span id="{{isset($credential->parent_id)?'modal_':''}}bank_letter_image_name"></span>
                                </div>
                                <p class="m-0 resume_content text-right text-grey w-75">Bank Letter/Void Cheque</p>
                            </div>
                            <div class="d-flex doc_file_uploaded">
                                @php $bankimg_cnt =0; @endphp
                                @if(isset($credential) && $credential->credential_documents && $credential->credential_documents->bank_letter_image !=null)
                                    @foreach(explode(',',$credential->credential_documents->bank_letter_image)  as $img_index => $image)
                                        <div class="btn_pos"
                                             id="old_bank_letter_img{{$img_index}}">
                                            <a class="btn btn-sm btn-outline-info m-1"
                                               download
                                               href="{{asset('public/credential_images/'.$image)}}">
                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                File<span class=""></span></a>
                                            <i class="fa fa-times-circle"
                                               onclick="remove_bank_letter_image({{$img_index}})"
                                               title="Remove File"></i>
                                        </div>
                                        <input type="hidden"
                                               name="old_bank_letter_image[{{$img_index}}]"
                                               value="{{$image}}"
                                               id="old_bank_letter_image_{{$img_index}}"
                                               class="">
                                        @php $bankimg_cnt ++; @endphp
                                    @endforeach
                                @endif
                                <input type="hidden" name="bankimg_cnt" id="bankimg_cnt"
                                       value="<?php echo $bankimg_cnt;?>">
                            </div>
                        </div>

                        <div class="upload-doc">
                            <div class="">
                                @if(isset($credential) && $credential->document_status!=null && $credential->document_status->driver_license_image==1)
                                    <span><i class="fa fa-check-circle text-success"></i></span>
                                @elseif(isset($credential) && $credential->document_status!=null && $credential->document_status->driver_license_image==2)
                                    <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->document_status->driver_license_image_message}}</span>
                                @else
                                @endif
                            </div>
                            <div class="align-items-center d-flex justify-content-between p-2 resume">
                                <div class="w-100">
                                    <label for="{{isset($credential->parent_id)?'modal_':''}}driver_license_image" class="choose-a-file"><input accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" id="{{isset($credential->parent_id)?'modal_':''}}driver_license_image" class="d-none" name="driver_license_image[]" type="file" multiple value="" placeholder="" >Choose File</label> <span id="{{isset($credential->parent_id)?'modal_':''}}driver_license_image_name"></span>
                                </div>
                                <p class="m-0 resume_content text-right text-grey w-75">Drivers License</p>
                            </div>
                            <div class="d-flex doc_file_uploaded">
                                @php $driverimg_cnt =0; @endphp
                                @if(isset($credential) && $credential->credential_documents && $credential->credential_documents->driver_license_image !=null)
                                    @foreach(explode(',',$credential->credential_documents->driver_license_image)  as $img_index => $image)
                                        <div class="btn_pos"
                                             id="old_driver_license_img{{$img_index}}">
                                            <a class="btn btn-sm btn-outline-info m-1"
                                               download
                                               href="{{asset('public/credential_images/'.$image)}}">
                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                File<span class=""></span></a>
                                            <i class="fa fa-times-circle"
                                               onclick="remove_driver_license_image_image({{$img_index}})"
                                               title="Remove File"></i>
                                        </div>
                                        <input type="hidden"
                                               name="old_driver_license_image[{{$img_index}}]"
                                               value="{{$image}}"
                                               id="old_driver_license_image_{{$img_index}}"
                                               class="">
                                        @php $driverimg_cnt ++; @endphp
                                    @endforeach
                                @endif
                                <input type="hidden" name="driverimg_cnt"
                                       id="driverimg_cnt"
                                       value="<?php echo $driverimg_cnt;?>">
                            </div>
                        </div>
                        <a href="https://www.irs.gov/pub/irs-pdf/fw9.pdf" class="mb-n2 ml-auto mr-4 text-primary {{isset($credential) && $credential->parent_id!=null?'d-none':''}}" download="W9 Form" target="_blank">Download W9 Form</a>
                        <div class="upload-doc {{isset($credential) && $credential->parent_id!=null?'d-none':''}}">
                            <div class="">
                                @if(isset($credential) && $credential->document_status!=null && $credential->document_status->w9_form_image==1)
                                    <span><i class="fa fa-check-circle text-success"></i></span>
                                @elseif(isset($credential) && $credential->document_status!=null && $credential->document_status->w9_form_image==2)
                                    <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->document_status->w9_form_image_message}}</span>
                                @else
                                @endif
                            </div>
                            <div class="align-items-center d-flex justify-content-between p-2 resume">
                                <div class="w-100">
                                    <label for="{{isset($credential->parent_id)?'modal_':''}}w9_form_image" class="choose-a-file"><input accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" id="{{isset($credential->parent_id)?'modal_':''}}w9_form_image" class="d-none" name="w9_form_image[]" type="file" multiple value="" placeholder="" >Choose File</label> <span id="{{isset($credential->parent_id)?'modal_':''}}w9_form_image_name"></span>
                                </div>
                                <p class="m-0 resume_content text-right text-grey w-75">W9 Form </p>
                            </div>
                            <div class="d-flex doc_file_uploaded">
                                @php $w9img_cnt =0; @endphp
                                @if(isset($credential) && $credential->credential_documents && $credential->credential_documents->w9_form_image !=null)
                                    @foreach(explode(',',$credential->credential_documents->w9_form_image)  as $img_index => $image)
                                        <div class="btn_pos"
                                             id="old_w9_form_img{{$img_index}}">
                                            <a class="btn btn-sm btn-outline-info m-1"
                                               download
                                               href="{{asset('public/credential_images/'.$image)}}">
                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                File<span class=""></span></a>
                                            <i class="fa fa-times-circle"
                                               onclick="remove_w9_form_image({{$img_index}})"
                                               title="Remove File"></i>
                                        </div>
                                        <input type="hidden"
                                               name="old_w9_form_image[{{$img_index}}]"
                                               value="{{$image}}"
                                               id="old_w9_form_image_{{$img_index}}"
                                               class="">
                                        @php $w9img_cnt ++; @endphp
                                    @endforeach
                                @endif
                                <input type="hidden" name="w9img_cnt" id="w9img_cnt"
                                       value="<?php echo $w9img_cnt;?>">
                            </div>
                        </div>
                        <div class="upload-doc">
                            <div class="">
                                @if(isset($credential) && $credential->document_status!=null && $credential->document_status->resume_image==1)
                                    <span><i class="fa fa-check-circle text-success"></i></span>
                                @elseif(isset($credential) && $credential->document_status!=null && $credential->document_status->resume_image==2)
                                    <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->document_status->resume_image_message}}</span>
                                @else
                                @endif
                            </div>
                            <div class="align-items-center d-flex justify-content-between p-2 resume">
                                <div class="w-100">
                                    <label for="{{isset($credential->parent_id)?'modal_':''}}resume_image" class="choose-a-file"><input accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" id="{{isset($credential->parent_id)?'modal_':''}}resume_image" class="d-none" name="resume_image[]" type="file" multiple value="" placeholder="" >Choose File</label> <span id="{{isset($credential->parent_id)?'modal_':''}}resume_image_name"></span>
                                </div>
                                <p class="m-0 resume_content text-right text-grey w-75">Resume(CV)</p>
                            </div>
                            <div class="d-flex doc_file_uploaded">
                                @php $rimg_cnt =0; @endphp
                                @if(isset($credential) && $credential->credential_documents && $credential->credential_documents->resume_image !=null)
                                    @foreach(explode(',',$credential->credential_documents->resume_image)  as $img_index => $image)
                                        <div class="btn_pos"
                                             id="old_resume_img{{$img_index}}">
                                            <a class="btn btn-sm btn-outline-info m-1"
                                               download
                                               href="{{asset('public/credential_images/'.$image)}}">
                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                File<span class=""></span></a>
                                            <i class="fa fa-times-circle"
                                               onclick="remove_resume_image({{$img_index}})"
                                               title="Remove File"></i>
                                        </div>
                                        <input type="hidden"
                                               name="old_resume_image[{{$img_index}}]"
                                               value="{{$image}}"
                                               id="old_resume_image_{{$img_index}}"
                                               class="">
                                        @php $rimg_cnt ++; @endphp
                                    @endforeach
                                @endif
                                <input type="hidden" name="rimg_cnt" id="rimg_cnt"
                                       value="<?php echo $rimg_cnt;?>">
                            </div>
                        </div>
                        <div class="upload-doc">
                            <div class="">
                                @if(isset($credential) && $credential->document_status!=null && $credential->document_status->degree_image==1)
                                    <span><i class="fa fa-check-circle text-success"></i></span>
                                @elseif(isset($credential) && $credential->document_status!=null && $credential->document_status->degree_image==2)
                                    <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->document_status->degree_image_message}}</span>
                                @else
                                @endif
                            </div>
                            <div class="align-items-center d-flex justify-content-between p-2 resume">
                                <div class="w-100">
                                    <label for="{{isset($credential->parent_id)?'modal_':''}}degree_image" class="choose-a-file"><input accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" id="{{isset($credential->parent_id)?'modal_':''}}degree_image" class="d-none" name="degree_image[]" type="file" multiple value="" placeholder="" >Choose File</label> <span id="{{isset($credential->parent_id)?'modal_':''}}degree_image_name"></span>
                                </div>
                                <p class="m-0 resume_content text-right text-grey w-75">Degree</p>
                            </div>
                            <div class="d-flex doc_file_uploaded">
                                @php $dimg_cnt =0; @endphp
                                @if(isset($credential) && $credential->credential_documents && $credential->credential_documents->degree_image !=null)
                                    @foreach(explode(',',$credential->credential_documents->degree_image)  as $img_index => $image)
                                        <div class="btn_pos"
                                             id="old_degree_img{{$img_index}}">
                                            <a class="btn btn-sm btn-outline-info m-1"
                                               download
                                               href="{{asset('public/credential_images/'.$image)}}">
                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                File<span class=""></span></a>
                                            <i class="fa fa-times-circle"
                                               onclick="remove_degree_image({{$img_index}})"
                                               title="Remove File"></i>
                                        </div>
                                        <input type="hidden"
                                               name="old_degree_image[{{$img_index}}]"
                                               value="{{$image}}"
                                               id="old_degree_image_{{$img_index}}"
                                               class="">
                                        @php $dimg_cnt ++; @endphp
                                    @endforeach
                                @endif
                                <input type="hidden" name="rimg_cnt" id="rimg_cnt"
                                       value="<?php echo $dimg_cnt;?>">
                            </div>
                        </div>
                        <div class="upload-doc">
                            <div class="">
                                @if(isset($credential) && $credential->document_status!=null && $credential->document_status->board_certification_image==1)
                                    <span><i class="fa fa-check-circle text-success"></i></span>
                                @elseif(isset($credential) && $credential->document_status!=null && $credential->document_status->board_certification_image==2)
                                    <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->document_status->board_certification_image_message}}</span>
                                @else
                                @endif
                            </div>
                            <div class="align-items-center d-flex justify-content-between p-2 resume">
                                <div class="w-100">
                                    <label for="{{isset($credential->parent_id)?'modal_':''}}board_certification_image" class="choose-a-file"><input accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" id="{{isset($credential->parent_id)?'modal_':''}}board_certification_image" class="d-none" name="board_certification_image[]" type="file" multiple value="" placeholder="" >Choose File</label> <span id="{{isset($credential->parent_id)?'modal_':''}}board_certification_image_name"></span>
                                </div>
                                <p class="m-0 resume_content text-right text-grey w-75">Board Certification</p>
                            </div>
                            <div class="d-flex doc_file_uploaded">
                                @php $bcimg_cnt =0; @endphp
                                @if(isset($credential) && $credential->credential_documents && $credential->credential_documents->board_certification_image !=null)
                                    @foreach(explode(',',$credential->credential_documents->board_certification_image)  as $img_index => $image)
                                        <div class="btn_pos"
                                             id="old_board_certification_img{{$img_index}}">
                                            <a class="btn btn-sm btn-outline-info m-1"
                                               download
                                               href="{{asset('public/credential_images/'.$image)}}">
                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                File<span class=""></span></a>
                                            <i class="fa fa-times-circle"
                                               onclick="remove_board_certification_image({{$img_index}})"
                                               title="Remove File"></i>
                                        </div>
                                        <input type="hidden"
                                               name="old_board_certification_image[{{$img_index}}]"
                                               value="{{$image}}"
                                               id="old_board_certification_image_{{$img_index}}"
                                               class="">
                                        @php $bcimg_cnt ++; @endphp
                                    @endforeach
                                @endif
                                <input type="hidden" name="rimg_cnt" id="rimg_cnt"
                                       value="<?php echo $dimg_cnt;?>">
                            </div>
                        </div>
                        <div class="upload-doc">
                            <div class="">
                                @if(isset($credential) && $credential->document_status!=null && $credential->document_status->additional_document_image==1)
                                    <span><i class="fa fa-check-circle text-success"></i></span>
                                @elseif(isset($credential) && $credential->document_status!=null && $credential->document_status->additional_document_image==2)
                                    <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->document_status->additional_document_image_message}}</span>
                                @else
                                @endif
                            </div>
                            <div class="align-items-center d-flex justify-content-between p-2 resume">
                                <div class="w-100">
                                    <label for="{{isset($credential->parent_id)?'modal_':''}}additional_document_image" class="choose-a-file"><input accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" id="{{isset($credential->parent_id)?'modal_':''}}additional_document_image" class="d-none" name="additional_document_image[]" type="file" multiple value="" placeholder="" >Choose File</label> <span id="{{isset($credential->parent_id)?'modal_':''}}additional_document_image_name"></span>
                                </div>
                                <p class="m-0 resume_content text-right text-grey w-75">Any additional documents for your specialty</p>
                            </div>
                            <div class="d-flex doc_file_uploaded">
                                @php $additionalimg_cnt =0; @endphp
                                @if(isset($credential) && $credential->credential_documents && $credential->credential_documents->additional_document_image !=null)
                                    @foreach(explode(',',$credential->credential_documents->additional_document_image)  as $img_index => $image)
                                        <div class="btn_pos"
                                             id="old_additional_document_img{{$img_index}}">
                                            <a class="btn btn-sm btn-outline-info m-1"
                                               download
                                               href="{{asset('public/credential_images/'.$image)}}">
                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                File<span class=""></span></a>
                                            <i class="fa fa-times-circle"
                                               onclick="remove_additional_document_image({{$img_index}})"
                                               title="Remove File"></i>
                                        </div>
                                        <input type="hidden"
                                               name="old_additional_document_image[{{$img_index}}]"
                                               value="{{$image}}"
                                               id="old_additional_document_image_{{$img_index}}"
                                               class="">
                                        @php $additionalimg_cnt ++; @endphp
                                    @endforeach
                                @endif
                                <input type="hidden" name="additionalimg_cnt"
                                       id="additionalimg_cnt"
                                       value="<?php echo $additionalimg_cnt;?>">
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-center my-3 w-100">
                            <button type="submit" class="Next_btn">Next</button>
                        </div>
                    </div>
                </form>
            </fieldset>
            @php
                if(isset($credential)){if($credential->credential_documents!==null ){$show = true; $hide = false;} else {$show = false; $hide = true;}}
            @endphp
            <fieldset @class(['d-block' => $show, 'd-none'=>$hide]) class="" id="{{isset($credential->parent_id)?'modal_':''}}fieldset_step6">
                <div class="successful_step_individual h-100 d-flex justify-content-center align-items-center my-5 flex-column">
                    <img  src="{{asset('public/assets/images/new_theme/success-icon.png')}}" class="my-2" alt="success" >
                    <h3 class="text-grey">Success</h3>
                    <p class="text-grey">You have completed all the Steps</p>
                </div>
                @if(isset($credential->parent_id))
                    <a href="#" id="add_new_providers"  onclick="individual_form_modal({{$credential->parent_id}})">
                        <div class="add_new_prov d-flex justify-content-center ">
                            <img src="{{asset('public/assets/images/new_theme/add_new_p.png')}}" class="mx-2" style="width: 20px; height: fit-content;"  alt="success">
                            <p class="text-grey">Add New Provider</p>
                        </div>
                    </a>
                @endif
                <div class="d-flex justify-content-center my-3 w-100">
                    <a href="{{count(Auth::user()->group_credential) > 0?route('group_dashboard'):route('user_dashboard')}}" class="Next_btn text-center" >Go To Dashboard</a>
                </div>
            </fieldset>
        </div>
    </div>
</div>
