
<div class="tab-pane fade" id="profile" role="tabpanel" aria - labelledby="profile-tab">
    <div class="col">
        <div class="ttm-col-bgcolor-yes ttm-bg ttm-bgcolor-grey z-index-1">
            <div class="ttm-col-wrapper-bg-layer ttm-bg-layer"></div>
            <div class="layer-content">
                {{--                                            <!--testimonial - box-- >--}}
                <div class="pt-45 pl-50 pb-50 pr-50 res-991-pl-15 res-991-pr-15 res-991-pt-30">
                    {{--                                                <!--section - title-- >--}}
                    <div class="section-title">
                        <div class="title-header">
                            <h3> User Profile </h3>
                            <h2 class="title"> Profile <span
                                        class="ttm-textcolor-skincolor"> Form .</span></h2>
                        </div>
                    </div>
                    {{--                                                <!--section - title end-- >--}}
                    <form id="profile_form"
                          class="ttm-contactform-2 wrap-form clearfix"
                          action="javascript:profile_form_submit();">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id"
                               value="{{Auth::user()->user_id}}">
                        <div id="" class="">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label>Full Name</label>
                                    <input name="full_name" type="text"
                                           value="{{Auth::user()->full_name}}" required>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label>Old Password</label>
                                    <input name="old_password" type="password" id="old_password"
                                           value="" onchange="old_password_f(this)" autocomplete="off">
                                    <span style="color: red" id="old_password_message" ></span>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label>New Password</label>
                                    <input name="new_password" type="password" id="new_password" value="" oninput="create_new_password()" readonly>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label>Confirm Password</label>
                                    <input name="confirm_password" id="confirm_password" type="password" value="" oninput="create_new_password()" readonly>
                                    <span style="color: red" id="confirm_password_message"></span>
                                </div>
                            </div>
                        </div>
                        <button class="submit my-3 ttm-btn ttm-btn-size-md ttm-btn-shape-round ttm-btn-style-fill ttm-btn-color-skincolor float-right"
                                type="submit" id="submit_btn">Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    var auth_var = 0;
    function old_password_f(obj){
        var old_pass = $(obj).val();
        var user_id = $('#user_id').val();
        var _token = "{{csrf_token()}}";
        $.ajax({
            type:'POST',
            url:"{{ route('checking_password') }}",
            data:{old_pass:old_pass, user_id:user_id, _token:_token},
            success:function(data){
                if(data.status=='Failure'){
                    $('#old_password_message').text(data.result);
                    $('#submit_btn').attr("disabled", "disabled");
                     auth_var = 1;
                } else{
                    $('#old_password_message').text('');
                    $('#new_password').attr("readonly", false);
                    $('#confirm_password').attr("readonly", false);
                    $('#submit_btn').attr("disabled", false);
                    $('#old_password').attr("readonly", 'readonly');
                    // $('#old_password_message1').text('your password Correct');
                     auth_var = 0;
                }
            }
        });
    }
    function create_new_password(){
        var new_password = $('#new_password').val();
        var confirm_password = $('#confirm_password').val();
            if (new_password != confirm_password) {
                $('#confirm_password_message').text('Password Not Matching');
                $('#submit_btn').attr("disabled", "disabled");
                 auth_var = 1;
            } else {
                $('#confirm_password_message').text('');
                $('#submit_btn').attr("disabled", false);
                 auth_var = 0;
            }
    }
    function profile_form_submit() {
        let data = new FormData($('#profile_form')[0]);
        if(auth_var==0){
        let a = function () {
            // window.location.reload();
            var loc = window.location;
            $(location).attr('href','http://'+loc.host+loc.pathname+'/#profile/');
        };
        let arr = [a];
        var rslt = call_ajax_with_functions('', '{{route('update_user_profile')}}', data, arr);
    }
    }
</script>