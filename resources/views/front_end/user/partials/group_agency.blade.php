<div class="col" id="form">
    <div class="row p-5">
        <div class="col-lg-5">
            <div class="steps_list">
                <ul id="progressbar" class="d-flex flex-column">
                    <li class="d-flex w-100 my-2 align-items-center active visited step group_step1" onclick="group_back_change_steps(0)"  id="step1"data-title="1">
                        <strong class="mx-4" >Select Option</strong>
                    </li>
                    <li id="step2" onclick="group_back_change_steps(1)" class="d-flex w-100 my-2 align-items-center step group_step2  @if(isset($credential)) @if($credential->form_type!=null && $credential->ein_tin==null)   active  @elseif($credential->ein_tin!=null && $credential->form_type!=null) visited active @else ''  @endif @endif" data-title="2">
                        <strong class="mx-4" >Group Details</strong>
                    </li>
                    <li id="step3" onclick="group_back_change_steps(2)" class="d-flex w-100 my-2 align-items-center step group_step3  @if(isset($credential)) @if($credential->ein_tin!=null && $credential->credential_documents==null)   active  @elseif($credential->ein_tin!=null && $credential->credential_documents!=null) visited active @else ''  @endif @endif" data-title="3">
                        <strong class="mx-4" >Document Upload</strong>
                    </li>
                    <li id="step4" onclick="group_back_change_steps(3)" class="d-flex w-100 my-2 align-items-center step group_step4  @if(isset($credential)) @if($credential->credential_documents!=null)   active  @else ''  @endif @endif" data-title=">">
                        <strong class="mx-4" >Success</strong>
                    </li>
{{--                    <li id="step5" onclick="group_back_change_steps(4)" class="d-flex w-100 my-2 align-items-center step group_step5  @if(isset($credential)) @if(count($credential->insurances)!=0 && $credential->credential_documents==null)   active  @elseif(count($credential->insurances)!=0 && $credential->credential_documents!=null) visited active @else ''  @endif @endif" data-title="5">--}}
{{--                        <strong class="mx-4" >Document Upload</strong>--}}
{{--                    </li>--}}
{{--                    <li id="step6" onclick="group_back_change_steps(5)" class="d-flex w-100 my-2 align-items-center step group_step6  @if(isset($credential)) @if($credential->credential_documents!=null) active  @else ''  @endif @endif" data-title=">">--}}
{{--                        <strong class="mx-4" >Success</strong>--}}
{{--                    </li>--}}
                </ul>
            </div>
        </div>
        <div class="col-lg-7 p-3" style="background-color: #ffffff !important;">
            <h2 class="fw-bold my-2 pt-3 d-none text-center text-grey">Configure your RCM Account</h2>
            <fieldset class="" id="fieldset_step1">
            </fieldset>
            @php
                if(isset($credential)){if($credential->form_type!==null && $credential->ein_tin==null){$show = true; $hide = false;} else {$show = false; $hide = true;}}
            @endphp
            <fieldset id="group_fieldset_step2" @if(isset($credential)) @class(['d-block' => $show, 'd-none'=>$hide]) @endif>
                <div class="">
                    <div class="form_login">
                        <form action="javascript:group_step_2_form_submit();" id="group_step_2_form_id" class="">
                            <h4 class="py-1 text-grey text-center">Group Details</h4>
                            @csrf
                            <input type="hidden" name="form_type" value="credentialing_agencies">
                            <div class="configure_form">
                                <input type="text" name="group_name" value="{{isset($credential->group_name)?($credential->group_name):''}}" required autocomplete="off" >
                                <label for="name" class="label-name">
                                    <span class="content-name">Group Name <span class="text-info">*</span>
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
                                <input type="text" name="group_npi" value="{{isset($credential->group_npi)?($credential->group_npi):''}}" required autocomplete="off">
                                <label for="name" class="label-name">
                                    <span class="content-name">Group NPI <span class="text-info">*</span>
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
                                        @elseif(isset($credential) && $credential->credential_statuses!=null && $credential->credential_statuses->group_name==2)
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
                                <input type="text" name="service_address" id="group_service_address" value="{{isset($credential->service_address)?($credential->service_address):''}}" required autocomplete="off">
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
                                <input type="checkbox" name="check_address" class="d-block" {{isset($credential->check_address)?($credential->check_address==1?'checked':''):''}} title="Billing address same as Service address" value="1" id="group_billing_address"></span>
                                <p class="text-grey m-0 mx-1" style="font-size: 13px;">Billing Address same as Service Address*</p>
                            </div>
                            <div class="configure_form" >
                                <input type="text" name="billing_mailing_address" id="group_billing_mailing_address" value="{{isset($credential->billing_mailing_address)?($credential->billing_mailing_address):''}}" required autocomplete="off">
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
                            <div class="d-flex justify-content-center my-3 w-100">
                                <button type="submit" class="Next_btn" id="group_step2_submit">Next</button>
                            </div>
                        </form>
                    </div>
                </div>
            </fieldset>
            @php
                if(isset($credential)){if($credential->ein_tin!==null && $credential->credential_documents==null){$show = true; $hide = false;} else {$show = false; $hide = true;}}
            @endphp
            <fieldset id="group_fieldset_step3" @if(isset($credential)) @class(['d-block' => $show, 'd-none'=>$hide]) @endif ">
            <div class="">
                <form action="javascript:group_step_5_form_submit();" id="group_step_5_form_id" class="" >
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        @csrf
                        <input type="hidden" name="credential_id" value="{{isset($credential)?$credential->credential_id:''}}">
                        <h4 class="py-1 text-grey">Upload Documents</h4>

                        <div class="upload-doc d-none">
                            <div class="">
                                @if(isset($credential) && $credential->document_status!=null && $credential->document_status->state_license_image==1)
                                    <span><i class="fa fa-check-circle text-success"></i></span>
                                @elseif(isset($credential) && $credential->document_status!=null && $credential->document_status->state_license_image==2)
                                    <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->document_status->state_license_image_message}}</span>
                                @else
                                @endif
                            </div><div class="align-items-center d-flex justify-content-between p-2 resume">
                                <div class="w-100">
                                    <label for="group_state_license_image" class="choose-a-file"><input accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" id="group_state_license_image" class="d-none" name="state_license_image[]" type="file" multiple value="" placeholder="" >Choose File</label> <span id="group_state_license_image_name"></span>
                                </div>
                                <p class="m-0 resume_content text-right text-grey w-75">State License</p>
                            </div>
                            <div class="d-flex doc_file_uploaded">
                                @php $stateimg_cnt=0; @endphp
                                @if(isset($credential) && $credential->credential_documents && $credential->credential_documents->state_license_image !=null)
                                    @foreach(explode(',',$credential->credential_documents->state_license_image)  as $img_index => $image)
                                        <div class="btn_pos"
                                             id="group_old_state_license_img{{$img_index}}">
                                            <a class="btn btn-sm btn-outline-info m-1"
                                               download
                                               href="{{asset('public/credential_images/'.$image)}}">
                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                File<span class=""></span></a>
                                            <i class="fa fa-times-circle text-danger"
                                               onclick="group_remove_state_license_image({{$img_index}})"
                                               title="Remove File"></i>
                                        </div>
                                        <input type="hidden"
                                               name="old_state_license_image[{{$img_index}}]"
                                               value="{{$image}}"
                                               id="group_old_state_license_image_{{$img_index}}"
                                               class="">
                                        @php $stateimg_cnt ++; @endphp
                                    @endforeach
                                @endif
                                <input type="hidden" name="stateimg_name"
                                       id="stateimg_cnt"
                                       value="<?php echo $stateimg_cnt;?>">
                            </div>
                        </div>
                        <div class="upload-doc d-none">
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
                                    <label for="group_accreditation_image" class="choose-a-file"><input accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" id="group_accreditation_image" class="d-none" name="accreditation_image[]" type="file" multiple value="" placeholder="" >Choose File</label> <span id="group_accreditation_image_name"></span>
                                </div>
                                <p class="m-0 resume_content text-right text-grey w-75">Accreditation</p>
                            </div>
                            <div class="d-flex doc_file_uploaded">
                                @php $credentialimg_cnt =0; @endphp
                                @if(isset($credential) && $credential->credential_documents && $credential->credential_documents->accreditation_image !=null)
                                    @foreach(explode(',',$credential->credential_documents->accreditation_image)  as $img_index => $image)
                                        <div class="btn_pos"
                                             id="group_old_accreditation_img{{$img_index}}">
                                            <a class="btn btn-sm btn-outline-info m-1"
                                               download
                                               href="{{asset('public/credential_images/'.$image)}}">
                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                File<span class=""></span></a>
                                            <i class="fa fa-times-circle"
                                               onclick="group_remove_accreditation_image({{$img_index}})"
                                               title="Remove File"></i>
                                        </div>
                                        <input type="hidden"
                                               name="old_accreditation_image[{{$img_index}}]"
                                               value="{{$image}}"
                                               id="group_old_accreditation_image_{{$img_index}}"
                                               class="">
                                        @php $credentialimg_cnt ++; @endphp
                                    @endforeach
                                @endif
                                <input type="hidden" name="credentialimg_cnt"
                                       id="credentialimg_cnt"
                                       value="<?php echo $credentialimg_cnt;?>">
                            </div>
                        </div>

                        <div class="upload-doc">
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
                                    <label for="group_irs_letter_image" class="choose-a-file"><input accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" id="group_irs_letter_image" class="d-none" name="irs_letter_image[]" type="file" multiple value="" placeholder="" >Choose File</label> <span id="group_irs_letter_image_name"></span>
                                </div>
                                <p class="m-0 resume_content text-right text-grey w-75">IRS Letter</p>
                            </div>
                            <div class="d-flex doc_file_uploaded">
                                @php $irsimg_cnt=0; @endphp
                                @if(isset($credential) && $credential->credential_documents && $credential->credential_documents->irs_letter_image !=null)
                                    @foreach(explode(',',$credential->credential_documents->irs_letter_image)  as $img_index => $image)
                                        <div class="btn_pos"
                                             id="group_old_irs_letter_img{{$img_index}}">
                                            <a class="btn btn-sm btn-outline-info m-1"
                                               download
                                               href="{{asset('public/credential_images/'.$image)}}">
                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                File<span class=""></span></a>
                                            <i class="fa fa-times-circle"
                                               onclick="group_remove_irs_letter_image({{$img_index}})"
                                               title="Remove File"></i>
                                        </div>
                                        <input type="hidden"
                                               name="old_irs_letter_image[{{$img_index}}]"
                                               value="{{$image}}"
                                               id="group_old_irs_letter_image_{{$img_index}}"
                                               class="">
                                        @php $irsimg_cnt ++; @endphp
                                    @endforeach
                                @endif
                                <input type="hidden" name="irsimg_cnt" id="irsimg_cnt"
                                       value="<?php echo $irsimg_cnt;?>">
                            </div>
                        </div>

                        <div class="upload-doc">
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
                                    <label for="group_professional_liability_insurance_image" class="choose-a-file"><input accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" id="group_professional_liability_insurance_image" class="d-none" name="professional_liability_insurance_image[]" type="file" multiple value="" placeholder="" >Choose File</label> <span id="group_professional_liability_insurance_image_name"></span>
                                </div>
                                <p class="m-0 resume_content text-right text-grey w-75">Professional Liability Insurance/MalPractise</p>
                            </div>
                            <div class="d-flex doc_file_uploaded">
                                @php $professionalimg_cnt =0; @endphp
                                @if(isset($credential) && $credential->credential_documents && $credential->credential_documents->professional_liability_insurance_image !=null)
                                    @foreach(explode(',',$credential->credential_documents->professional_liability_insurance_image)  as $img_index => $image)
                                        <div class="btn_pos"
                                             id="group_old_professional_liability_insurance_img{{$img_index}}">
                                            <a class="btn btn-sm btn-outline-info m-1"
                                               download
                                               href="{{asset('public/credential_images/'.$image)}}">
                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                File<span class=""></span></a>
                                            <i class="fa fa-times-circle"
                                               onclick="group_remove_professional_liability_insurance_image({{$img_index}})"
                                               title="Remove File"></i>
                                        </div>
                                        <input type="hidden"
                                               name="old_professional_liability_insurance_image[{{$img_index}}]"
                                               value="{{$image}}"
                                               id="group_old_professional_liability_insurance_image_{{$img_index}}"
                                               class="">
                                        @php $professionalimg_cnt ++; @endphp
                                    @endforeach
                                @endif
                                <input type="hidden" name="professionalimg_cnt"
                                       id="professionalimg_cnt"
                                       value="<?php echo $professionalimg_cnt;?>">
                            </div>
                        </div>

                        <div class="upload-doc">
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
                                    <label for="group_bank_letter_image" class="choose-a-file"><input accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" id="group_bank_letter_image" class="d-none" name="bank_letter_image[]" type="file" multiple value="" placeholder="" >Choose File</label> <span id="group_bank_letter_image_name"></span>
                                </div>
                                <p class="m-0 resume_content text-right text-grey w-75">Bank Letter/Void Cheque</p>
                            </div>
                            <div class="d-flex doc_file_uploaded">
                                @php $bankimg_cnt =0; @endphp
                                @if(isset($credential) && $credential->credential_documents && $credential->credential_documents->bank_letter_image !=null)
                                    @foreach(explode(',',$credential->credential_documents->bank_letter_image)  as $img_index => $image)
                                        <div class="btn_pos"
                                             id="group_old_bank_letter_img{{$img_index}}">
                                            <a class="btn btn-sm btn-outline-info m-1"
                                               download
                                               href="{{asset('public/credential_images/'.$image)}}">
                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                File<span class=""></span></a>
                                            <i class="fa fa-times-circle"
                                               onclick="group_remove_bank_letter_image({{$img_index}})"
                                               title="Remove File"></i>
                                        </div>
                                        <input type="hidden"
                                               name="old_bank_letter_image[{{$img_index}}]"
                                               value="{{$image}}"
                                               id="group_old_bank_letter_image_{{$img_index}}"
                                               class="">
                                        @php $bankimg_cnt ++; @endphp
                                    @endforeach
                                @endif
                                <input type="hidden" name="bankimg_cnt" id="bankimg_cnt"
                                       value="<?php echo $bankimg_cnt;?>">
                            </div>
                        </div>

                        <div class="upload-doc d-none">
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
                                    <label for="group_driver_license_image" class="choose-a-file"><input accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" id="group_driver_license_image" class="d-none" name="driver_license_image[]" type="file" multiple value="" placeholder="" >Choose File</label> <span id="group_driver_license_image_name"></span>
                                </div>
                                <p class="m-0 resume_content text-right text-grey w-75">Drivers License</p>
                            </div>
                            <div class="d-flex doc_file_uploaded">
                                @php $driverimg_cnt =0; @endphp
                                @if(isset($credential) && $credential->credential_documents && $credential->credential_documents->driver_license_image !=null)
                                    @foreach(explode(',',$credential->credential_documents->driver_license_image)  as $img_index => $image)
                                        <div class="btn_pos"
                                             id="group_old_driver_license_img{{$img_index}}">
                                            <a class="btn btn-sm btn-outline-info m-1"
                                               download
                                               href="{{asset('public/credential_images/'.$image)}}">
                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                File<span class=""></span></a>
                                            <i class="fa fa-times-circle"
                                               onclick="group_remove_driver_license_image_image({{$img_index}})"
                                               title="Remove File"></i>
                                        </div>
                                        <input type="hidden"
                                               name="old_driver_license_image[{{$img_index}}]"
                                               value="{{$image}}"
                                               id="group_old_driver_license_image_{{$img_index}}"
                                               class="">
                                        @php $driverimg_cnt ++; @endphp
                                    @endforeach
                                @endif
                                <input type="hidden" name="driverimg_cnt"
                                       id="driverimg_cnt"
                                       value="<?php echo $driverimg_cnt;?>">
                            </div>
                        </div>
                        <a href="https://www.irs.gov/pub/irs-pdf/fw9.pdf" class="mb-n2 ml-auto mr-4 text-primary" download="W9 Form" target="_blank">Download W9 Form</a>
                        <div class="upload-doc">
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
                                    <label for="group_w9_form_image" class="choose-a-file"><input accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" id="group_w9_form_image" class="d-none" name="w9_form_image[]" type="file" multiple value="" placeholder="" >Choose File</label> <span id="group_w9_form_image_name"></span>
                                </div>
                                <p class="m-0 resume_content text-right text-grey w-75">W9 Form</p>
                            </div>
                            <div class="d-flex doc_file_uploaded">
                                @php $w9img_cnt =0; @endphp
                                @if(isset($credential) && $credential->credential_documents && $credential->credential_documents->w9_form_image !=null)
                                    @foreach(explode(',',$credential->credential_documents->w9_form_image)  as $img_index => $image)
                                        <div class="btn_pos"
                                             id="group_old_w9_form_img{{$img_index}}">
                                            <a class="btn btn-sm btn-outline-info m-1"
                                               download
                                               href="{{asset('public/credential_images/'.$image)}}">
                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                File<span class=""></span></a>
                                            <i class="fa fa-times-circle"
                                               onclick="group_remove_w9_form_image({{$img_index}})"
                                               title="Remove File"></i>
                                        </div>
                                        <input type="hidden"
                                               name="old_w9_form_image[{{$img_index}}]"
                                               value="{{$image}}"
                                               id="group_old_w9_form_image_{{$img_index}}"
                                               class="">
                                        @php $w9img_cnt ++; @endphp
                                    @endforeach
                                @endif
                                <input type="hidden" name="w9img_cnt" id="w9img_cnt"
                                       value="<?php echo $w9img_cnt;?>">
                            </div>
                        </div>
                        <div class="upload-doc d-none">
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
                                    <label for="group_resume_image" class="choose-a-file"><input accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" id="group_resume_image" class="d-none" name="resume_image[]" type="file" multiple value="" placeholder="" >Choose File</label> <span id="group_resume_image_name"></span>
                                </div>
                                <p class="m-0 resume_content text-right text-grey w-75">Resume(CV)</p>
                            </div>
                            <div class="d-flex doc_file_uploaded">
                                @php $rimg_cnt =0; @endphp
                                @if(isset($credential) && $credential->credential_documents && $credential->credential_documents->resume_image !=null)
                                    @foreach(explode(',',$credential->credential_documents->resume_image)  as $img_index => $image)
                                        <div class="btn_pos"
                                             id="group_old_resume_img{{$img_index}}">
                                            <a class="btn btn-sm btn-outline-info m-1"
                                               download
                                               href="{{asset('public/credential_images/'.$image)}}">
                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                File<span class=""></span></a>
                                            <i class="fa fa-times-circle"
                                               onclick="group_remove_resume_image({{$img_index}})"
                                               title="Remove File"></i>
                                        </div>
                                        <input type="hidden"
                                               name="old_resume_image[{{$img_index}}]"
                                               value="{{$image}}"
                                               id="group_old_resume_image_{{$img_index}}"
                                               class="">
                                        @php $rimg_cnt ++; @endphp
                                    @endforeach
                                @endif
                                <input type="hidden" name="rimg_cnt" id="rimg_cnt"
                                       value="<?php echo $rimg_cnt;?>">
                            </div>
                        </div>
                        <div class="upload-doc d-none">
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
                                    <label for="group_degree_image" class="choose-a-file"><input accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" id="group_degree_image" class="d-none" name="degree_image[]" type="file" multiple value="" placeholder="" >Choose File</label> <span id="group_degree_image_name"></span>
                                </div>
                                <p class="m-0 resume_content text-right text-grey w-75">Degree</p>
                            </div>
                            <div class="d-flex doc_file_uploaded">
                                @php $dimg_cnt =0; @endphp
                                @if(isset($credential) && $credential->credential_documents && $credential->credential_documents->degree_image !=null)
                                    @foreach(explode(',',$credential->credential_documents->degree_image)  as $img_index => $image)
                                        <div class="btn_pos"
                                             id="group_old_degree_img{{$img_index}}">
                                            <a class="btn btn-sm btn-outline-info m-1"
                                               download
                                               href="{{asset('public/credential_images/'.$image)}}">
                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                File<span class=""></span></a>
                                            <i class="fa fa-times-circle"
                                               onclick="group_remove_degree_image({{$img_index}})"
                                               title="Remove File"></i>
                                        </div>
                                        <input type="hidden"
                                               name="old_degree_image[{{$img_index}}]"
                                               value="{{$image}}"
                                               id="group_old_degree_image_{{$img_index}}"
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
                                @if(isset($credential) && $credential->document_status!=null && $credential->document_status->additional_document_image==1)
                                    <span><i class="fa fa-check-circle text-success"></i></span>
                                @elseif(isset($credential) && $credential->document_status!=null && $credential->document_status->additional_document_image==2)
                                    <span class="text-danger"><i class="fa fa-times-circle mr-1"></i>{{$credential->document_status->additional_document_image_message}}</span>
                                @else
                                @endif
                            </div>
                            <div class="align-items-center d-flex justify-content-between p-2 resume">
                                <div class="w-100">
                                    <label for="group_additional_document_image" class="choose-a-file"><input accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" id="group_additional_document_image" class="d-none" name="additional_document_image[]" type="file" multiple value="" placeholder="" >Choose File</label> <span id="group_additional_document_image_name"></span>
                                </div>
                                <p class="m-0 resume_content text-right text-grey w-75">Any additional documents for your specialty</p>
                            </div>
                            <div class="d-flex doc_file_uploaded">
                                @php $additionalimg_cnt =0; @endphp
                                @if(isset($credential) && $credential->credential_documents && $credential->credential_documents->additional_document_image !=null)
                                    @foreach(explode(',',$credential->credential_documents->additional_document_image)  as $img_index => $image)
                                        <div class="btn_pos"
                                             id="group_old_additional_document_img{{$img_index}}">
                                            <a class="btn btn-sm btn-outline-info m-1"
                                               download
                                               href="{{asset('public/credential_images/'.$image)}}">
                                                <span><i class="fa fa-download mr-2"></i></span>Download
                                                File<span class=""></span></a>
                                            <i class="fa fa-times-circle"
                                               onclick="group_remove_additional_document_image({{$img_index}})"
                                               title="Remove File"></i>
                                        </div>
                                        <input type="hidden"
                                               name="old_additional_document_image[{{$img_index}}]"
                                               value="{{$image}}"
                                               id="group_old_additional_document_image_{{$img_index}}"
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
            </div>
            </fieldset>
            @php
                if(isset($credential)){if($credential->credential_documents!==null){$show = true; $hide = false;} else {$show = false; $hide = true;}}
            @endphp
            <fieldset @if(isset($credential)) @class(['d-block' => $show, 'd-none'=>$hide]) @endif id="group_fieldset_step4">
                {{--This parent Id is to check whether it is group or not--}}
                <input type="hidden" name="" id="parent_id" value="{{isset($credential->parent_id)?$credential->parent_id:''}}" >
                @if(isset($list_providers))
                   <div class="row mt-5">
                       <div class="col-12">
                           <div class="card" style="border-radius: 10px;">
                               <div class="card-header bg-primary text-white w-100 text-center" style="border-top-left-radius: 10px;border-top-right-radius: 10px;">
                                   <h4>Select Available Providers</h4>
                               </div>
                               <div class="card-body bg-gray w-100">
                                   <form action="javascript:add_previous_provider()" id="previous_provider_id">
                                       @csrf
                                       <div class="row ">
                                           @foreach($list_providers as $provider)
                                               <div class="col-4">
                                                   <div class="align-items-baseline d-flex form-group">
                                                       <input type="checkbox" name="provider_credential_id[]" id="providers_checkbox" value="{{$provider->credential_id}}" style="-webkit-transform: scale(1.6);margin-right:4px; ">
                                                       <label class="mx-2 text-grey" style="display: inline;" for="">{{$provider->provider_name}}</label>
                                                   </div>
                                               </div>
                                           @endforeach
                                       </div>
                                       <div class="d-flex justify-content-center mt-5">
                                           <button type="submit" class="btn btn-primary mr-3">Add Selected Providers</button>
                                           <a href="#" onclick="individual_form_modal()" class="btn btn-secondary">Add New Provider</a>
                                       </div>
                                   </form>
                               </div>
                           </div>
                       </div>
                   </div>
                   @else
                   <a href="#" onclick="individual_form_modal()">
                       <div class="add_new_prov d-flex justify-content-center mt-5">
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
