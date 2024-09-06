<div class="tab-pane fade" id="billing" role="tabpanel" aria - labelledby="billing-tab">
    <div class="col">
        <div class="ttm-col-bgcolor-yes ttm-bg ttm-bgcolor-grey z-index-1">
            <div class="ttm-col-wrapper-bg-layer ttm-bg-layer"></div>
            <div class="layer-content">
                {{--                                            <!--testimonial - box-- >--}}
                <div class="pt-45 pl-50 pb-50 pr-50 res-991-pl-15 res-991-pr-15 res-991-pt-30">
                    {{--                                                <!--section - title-- >--}}
                    <div class="section-title">
                        <div class="title-header">
                            <h3> User Billing </h3>
                            <h2 class="title"> Billing <span
                                        class="ttm-textcolor-skincolor"> Form .</span></h2>
                        </div>
                    </div>
                    {{--                                                <!--section - title end-- >--}}
                    <form id="billing_form"
                          class="ttm-contactform-2 wrap-form clearfix"
                          action="javascript:billing_form_submit();">
                        @csrf
                        <input type="hidden" name="billing_id" id="bllng_id"
                               value="{{$billing?$billing->billing_id:''}}">
                        <div id="billing_form_id" class="">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label>Group Name</label>
                                    <input name="group_name" type="text"
                                           value="{{$billing?$billing->group_name:''}}"
                                           required>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label>Group NPI</label>
                                    <input maxlength="10" pattern=".{10,10}" required title="10 characters Are Required"
                                           type="text"
                                           name="group_npi"
                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"
                                           value="{{$billing?$billing->group_npi:''}}" required>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label>Legal Name on IRS letter</label>
                                    <input name="legal_name" type="text"
                                           value="{{$billing?$billing->legal_name:''}}">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label>EIN/TIN</label>
                                    {{--                                                                <input name="ein_tin" type="text"--}}
                                    {{--                                                                       value="{{$billing?$billing->ein_tin:''}}">--}}
                                    <input maxlength="9" pattern=".{9,9}" required title="9 characters Are Required"
                                           type="text" name="ein_tin"
                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"
                                           value="{{$billing?$billing->ein_tin:''}}" required>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label>Provider Name</label>
                                    <input name="provider_name" type="text"
                                           value="{{$billing?$billing->provider_name:''}}" required>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label>Provider NPI</label>
                                    <input name="provider_npi" type="number"
                                           value="{{$billing?$billing->provider_npi:''}}" required>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label>DOB</label>
                                    <input name="owner_dob" type="date"
                                           value="{{$billing?$billing->owner_dob:''}}">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label>Service Address</label>
                                    <input name="service_address" type="text"
                                           value="{{$billing?$billing->service_address:''}}" required>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label>Billing/Mailing Address</label>
                                    <input name="billing_mailing_address" type="text"
                                           value="{{$billing?$billing->billing_mailing_address:''}}">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label>Start date</label>
                                    <input name="start_date" type="date"
                                           value="{{$billing?$billing->start_date:''}}"
                                           placeholder="">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label>MEDICARE GROUP PTAN</label>
                                    <input name="medicare_group_ptan" type="text"
                                           value="{{$billing?$billing->medicare_group_ptan:''}}"
                                           placeholder="">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label>MEDICARE INDIVIDUAL PTAN</label>
                                    <input name="medicare_individual_ptan" type="text"
                                           value="{{$billing?$billing->medicare_individual_ptan:''}}"
                                           placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label>Billing Type</label>
                                    <select name="billing_type" value="" required>
                                        <option value="" selected disabled>Select...</option>
                                        @if($billing!='')
                                            <option value="innetwork"
                                                    @if($billing->billing_type=='innetwork') selected @endif>IN Network
                                            </option>
                                            <option value="outnetwork"
                                                    @if($billing->billing_type=='outnetwork') selected @endif>Out
                                                Network
                                            </option>
                                        @else
                                            <option value="innetwork">IN Network</option>
                                            <option value="outnetwork">Out Network</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label>SSN</label>
                                    <input maxlength="9" pattern=".{9,9}" required title="9 characters Are Required"
                                           type="text" name="ssn"
                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"
                                           value="{{$billing?$billing->ssn:''}}">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label>Medicare ID</label>
                                    <input type="text" name="medicare_id"
                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"
                                           value="{{$billing?$billing->medicare_id:''}}">
                                </div>
                            </div>
                            <div class="provider-field">
                                <div class="row">
                                    <div class="col-12">
                                        <h6>Software Logins</h6>
                                    </div>
                                    <br>
                                    <div class="col-lg-6">
                                        <label>
                                        <span class="text-input"><input
                                                    name="sftlg_username" type="text"
                                                    value="{{$billing?$billing->sftlg_username:''}}"
                                                    placeholder="username"></span>
                                        </label>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>
                                        <span class="text-input"><input
                                                    name="sftlg_password" type="text"
                                                    value="{{$billing?$billing->sftlg_password:''}}"
                                                    placeholder="password"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h6>Web-portal Logins </h6>
                                </div>
                                <br>
                                <div class="col-lg-6">
                                    <label>
                                    <span class="text-input"><input
                                                name="wbplg_username1" type="text" id="webp_username" class=""
                                                value=""
                                                placeholder="username"><span style="color: red" id="webp_username_message"></span></span>
                                    </label>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input type="text" name="wbplg_password1" id="webp_password" placeholder="password" class="form-control py-4">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" title="Add more" type="button" onclick="add_webp_field()">
                                                <i class="fa fa-plus font-19"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <span style="color: red" id="webp_password_message"></span>
                                </div>
                                <div class="col" id="webp_div">
                                    <?PHP if ($billing != null && $billing->wbplg_username!=null) {
                                        $wbplg_usernames = json_decode($billing->wbplg_username);
                                        $wbplg_password = json_decode($billing->wbplg_password);
                                        $webprw_cnt = 0;
                                        foreach ($wbplg_usernames as $wbplg_usernamekey => $wbplg_login) {
                                            $webprw_cnt = $webprw_cnt + 1;
                                                echo '<div class="row" id="webp_row-'.$webprw_cnt.'"><div class="col-lg-6">
                                    <labe>
                                    <span class="text-input"><input name="wbplg_username[]" type="text" value="'.$wbplg_login.'" placeholder="username"></span>
                                    </label>
                                </div>
                                 <div class="col-lg-6">
                                    <div class="input-group">
                                        <input name="wbplg_password[]" type="text" id="webp_password" value="'.$wbplg_password[$wbplg_usernamekey].'" class="form-control py-4">
                                        <div class="input-group-append">
                                            <button class="btn btn-danger" title="Add more" id="'.$webprw_cnt.'" type="button" onclick="remove_webp_field(this)">
                                                <i class="fa fa-minus font-19"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                </div>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h6>Documents </h6>
                                </div>
                                <br>
                                <input type="hidden" name="new_document_field_count" id="new_document_field_count" value="">
                                <div class="col-lg-12 mb-4">
                                    <div class="input-group">
                                        <input name="document" type="text" id="document_name" value="" placeholder="Document Name" class="form-control py-4">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" title="Add more"  type="button"  ONCLICK="add_documents_field()">
                                            <i class="fa fa-plus font-19"></i>
                                        </button>
                                    </div>
                                    </div>
                                    <span style="color: red" id="document_name_message"></span>
                                </div>
                                <div class="px-3" id="documents_div">
                                    <?php if ($billing_documents!=null) {
                                        $bill_dockey = 0;
                                        foreach($billing_documents as $bill_dockey => $billing_doc){
                                        $document_files = explode(',',$billing_doc->document_file);?>
                                    <input type="hidden" name="oldrow_document_id_{{$bill_dockey}}" value="{{$billing_doc->id}}">
                                            <div class="row" id="billdoc_oldrow-{{$bill_dockey}}">
                                    <div class="col-lg-6">
                                    <label>
                                    <span class="text-input"><input
                                                name="oldrow_document_name_{{$bill_dockey}}" type="text"
                                                value="{{$billing_doc->document_name}}"
                                                placeholder="username"></span>
                                    </label>
                                    </div>
                                <div class="col-lg-6">
                                    <div  class="input-group">
                                        <input  name="oldrow_doc_file_{{$bill_dockey}}[]" class="form-control form-control-lg" id="old_document_file-{{$billing_doc->id}}" type="file"  multiple {{$billing_doc->document_file==null?'required':''}}>
                                        <div class="input-group-append">
                                            <button class="btn btn-danger" title="Add more" type="button" id="{{$bill_dockey}}" data-prim_id="{{$billing_doc->id}}" onclick="remove_billdoc_oldfield(this)">
                                                <i class="fa fa-minus font-19"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @if(user_doc_status(Auth::user()->user_id, $billing_doc->document_name)!=null)
                                    <div class="row">
                                        <div class="col-12 ml-10 pl-4">
                                            @if(user_doc_status(Auth::user()->user_id, $billing_doc->document_name)->status ==2)
                                            <span class="badge badge-warning">
                                                Rejected:
                                                {{ user_doc_status(Auth::user()->user_id, $billing_doc->document_name)->reject_message }}
                                            </span>
                                            @elseif(user_doc_status(Auth::user()->user_id, $billing_doc->document_name)->status ==1)
                                                <span class="badge badge-success">
                                                    Approved
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                 <div class="col-12 my-3">
                                 <?php if($billing_doc->document_file!=null){ foreach ($document_files as $file_key => $document_file) { ?>
                                                <div class="btn_pos"
                                                     id="file_key-{{$file_key.$billing_doc->id}}">
                                                    <a class="btn btn-sm btn-outline-success m-1"
                                                       download
                                                       href='{{asset('public/billing_images/'.$document_file)}}'>
                                                        <span><i class="fa fa-download mr-2"></i></span>Download
                                                        File<span class=""></span></a>
                                                    <i class="fa fa-times-circle" data-file_name="{{$document_file}}" data-file_id="{{$billing_doc->id}}" data-file_key="{{$file_key.$billing_doc->id}}"
                                                       onclick="remove_document_singl_file(this)"
                                                       title="Remove File"></i>
                                                </div> <?php } } ?>
                                </div></div>
                                     <?php $bill_dockey = $bill_dockey; } ?>
                                        <input type="hidden" name="oldrow_document_count" id="oldrow_document_count" value="{{$bill_dockey+1}}">
                                    <?php } ?>

                                    <input type="hidden" name="deleted_rows" id="deleted_rows">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h6>List of insurances In-Network and Out of
                                        Network </h6>
                                </div>
                                <br>
                                <div class="col-lg-12 mb-4">
                                    <div class="input-group">
                                    <input id="insurance_network_list" class="form-control py-4" name="insuranceabc" value="" type="text">
                                        <div class="input-group-append">
                                            <button type="button"
                                                    class="btn btn-success"
                                                    ONCLICK="add_field()"><i class="fa fa-plus font-19"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <span style="color: red" id="insurance_network_list_message"></span>
                                </div>
                                <div class="col-lg-12" id="insurance_network_div">
                                    <?PHP if ($billing != null&&$billing->insurance_network_list!=null) {
                                        $netwokrs = json_decode($billing->insurance_network_list);
                                        $rw_cnt = 0;
                                        foreach ($netwokrs as $netwokrkey => $netwokr) {
                                            $rw_cnt = $rw_cnt + 1;
                                                echo '<div class="row" id="row-' . $rw_cnt . '">
                                                                        <div class="col-lg-12 mb-4">
                                                                        <div class="input-group">
                                                                        <input name="insurance_network_list[]" class="form-control py-4" type="text" value="' . $netwokr . '" placeholder="">
                                                                        <div class="input-group-append">
                                                                        <button type="button"
                                                                                class="btn btn-danger delete"
                                                                                id="' . $rw_cnt . '" onclick="remove_field(this)"><i class="fa fa-minus font-19"></i>
                                                                        </button>
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                    </div>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <label>Any Additional Note</label>
                        <textarea name="additional_note" rows="3"
                                  placeholder="Additional Note">{{$billing?$billing->additional_note:''}}</textarea>
                        <button class="submit my-3 ttm-btn ttm-btn-size-md ttm-btn-shape-round ttm-btn-style-fill ttm-btn-color-skincolor float-right"
                                type="submit">Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function billing_form_submit() {
        let data = new FormData($('#billing_form')[0]);
        let a = function () {
            var loc = window.location;
            $(location).attr('href','http://'+loc.host+loc.pathname+'/#billing/');
        };
        let arr = [a];
        var rslt = call_ajax_with_functions('', '{{route('billing_data_save')}}', data, arr);
        console.log(rslt);
    }
    <!-- start for appending row-->
    var cnt_row = 0;

    function add_field() {
        var insurance_network_list = $('#insurance_network_list').val();
        if(insurance_network_list!=''){
            $("#insurance_network_div").prepend(`<div class="row" id="row-` + cnt_row + `">
            <div class="col-lg-12 mb-4">
               <div class="input-group"> <input name="insurance_network_list[]" type="text" class="form-control py-4" value="` + insurance_network_list + `" placeholder=""
                                                spellcheck="false" data-ms-editor="true">
                         <div class="input-group-append">
                                        <button type="button" class="btn btn-danger delete" id="` + cnt_row + `" onclick="remove_field(this)"><i class="fa fa-minus font-19"></i></button>
                         </div>
               </div>
            </div>
        </div>`);
            $('#insurance_network_list_message').text("");
            cnt_row = cnt_row + 1;
        } else{
            $('#insurance_network_list_message').text("Please Enter Valid Information's");
        }
        $('#insurance_network_list').val('');
    }

    function remove_field(e) {
        var rowid = $(e).attr('id');
        $('#row-' + rowid).remove();
    }
    var cnt_webp_row =0;
    function add_webp_field() {
        var webp_username = $('#webp_username').val();
        var webp_password = $('#webp_password').val();
        if(webp_username!=''&&webp_password!=''){
            $("#webp_div").prepend(`<div class="row" id="webp_row-` + cnt_webp_row + `"><div class="col-lg-6">
                                    <label>
                                    <span class="text-input"><input
                                                name="wbplg_username[]" type="text"
                                                value="`+webp_username+`"
                                                placeholder="username"></span>
                                    </label>
                                </div>
<div class="col-lg-6">
                                <div class="input-group">
                                        <input name="wbplg_password[]" type="text" id="" value="`+webp_password+`"  placeholder="password" class="form-control py-4">
                                        <div class="input-group-append">
                                            <button title="Add more" type="button" class="btn btn-danger" id="` + cnt_webp_row + `" onclick="remove_webp_field(this)">
                                                <i class="fa fa-minus font-19"></i>
                                            </button>
                                        </div>
                                    </div>
</div>
</div>`);
            $('#webp_username').val('');
            $('#webp_password').val('');
            $('#webp_username_message').text("");
            $('#webp_password_message').text("");
            cnt_webp_row = cnt_webp_row + 1;
        } else{
            if(webp_username==''&&webp_password!=''){
                $('#webp_username_message').text("Please Enter Valid Information's");
                $('#webp_password_message').text("");
            } else if(webp_password==''&&webp_username!=''){
                $('#webp_password_message').text("Please Enter Valid Information's");
                $('#webp_username_message').text("");
            } else{
                $('#webp_username_message').text("Please Enter Valid Information's");
                $('#webp_password_message').text("Please Enter Valid Information's");
            }
        }
        $('#webp_username_list').val('');
    }

    function remove_webp_field(e) {
        var rowid = $(e).attr('id');
        $('#webp_row-' + rowid).remove();
    }
    var cnt_document_row = 0;
    function add_documents_field() {
        var document_name = $('#document_name').val();
        var document_file = $('#document_file').val();
        if(document_name!=''){
            $("#documents_div").prepend(`<div class="row" id="billdoc_newrow-` + cnt_document_row + `"><div class="col-lg-6">
                                    <label>
                                    <span class="text-input"><input
                                                name="new_document_name_`+cnt_document_row+`" type="text"
                                                value="`+document_name+`"
                                                placeholder="username" required></span>
                                    </label>
                                </div>
                               <div class="col-lg-6">
                                <div  class="input-group">
                                        <input   name="document_file-`+cnt_document_row+`[]" class="form-control form-control-lg"  type="file"  multiple required>
                                        <div class="input-group-append">
                                            <button class="btn btn-danger" title="Add more" type="button" id="` + cnt_document_row + `" onclick="remove_billdoc_newfield(this)">
                                                <i class="fa fa-minus font-19"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>`);
            $('#document_name').val('');
            $('#document_name_message').text("");
            cnt_document_row = cnt_document_row + 1;
            $('#new_document_field_count').val(cnt_document_row);
        } else{
            if(document_name==''){
                $('#document_name_message').text("Please Enter Valid Information's");
            }
        }
    }
    function remove_billdoc_newfield(e){
        var rowid = $(e).attr('id');
        var new_document_field_count = $('#new_document_field_count').val();
        $('#billdoc_newrow-' + rowid).remove();
        $('#new_document_field_count').val(new_document_field_count-1);
        cnt_document_row = cnt_document_row-1;
    }
    var deleted_rowsArray =[];
    function remove_billdoc_oldfield(e){
        var rowid = $(e).attr('id');
        var prim_id = $(e).attr('data-prim_id');
        var oldrow_document_count = $('#oldrow_document_count').val();
        $('#billdoc_oldrow-' + rowid).remove();
        $('#oldrow_document_count').val(oldrow_document_count-1);
        deleted_rowsArray.push(prim_id);
        $('#deleted_rows').val(deleted_rowsArray);
    }

    function remove_document_singl_file(obj){
        // alert($(obj).attr('data-file_name'));
        var img_name = $(obj).attr('data-file_name');
        var file_id = $(obj).attr('data-file_id');
        var file_key = $(obj).attr('data-file_key');
        var billing_id = $('#bllng_id').val();
        var token = "{{csrf_token()}}";
            let data = new FormData();
            data.append('img_name', img_name);
            data.append('billing_id', billing_id);
            data.append('file_id', file_id);
            data.append('_token', "{{csrf_token()}}");
        Swal.fire({
            title: 'Are you sure you want to delete this File?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type:'POST',
                    url:"{{ route('document_single_file_delete') }}",
                    data:{img_name:img_name,billing_id:billing_id, file_id:file_id, _token:token},
                    success:function(data){
                        console.log(data.files_id);
                        if(data.status=='Success'){
                            $('#file_key-'+file_key).remove();
                        }
                        if(data.result==0){
                            $('#old_document_file-'+data.files_id).attr("required", 'required');
                        }
                    }
                });
            }
        })
    }

</script>
