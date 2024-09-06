<?php
namespace App\Http\Controllers;
use App\Models\Credential;
use App\Models\UserCredentialStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function index()
    {
        if(Auth::user() && Auth::user()->user_id){
            if (Auth::user()->role_id!=3){
                $credential=Credential::has('credential_documents')->whereUserId(Auth::user()->user_id)->first();
                if ($credential !=null && $credential->form_type=='credentialing_individual_provider'){
                    return redirect('user_dashboard');
                }elseif ($credential !=null && $credential->form_type=='credentialing_agencies'){
                    return redirect('group_dashboard');
                }
                return redirect('/user_form');
            }else{
                return redirect('/billing_user_dashboard');
            }
        }
        $data['page_title'] = "RCM - Login";
        return view('front_end.Auth.login_form',$data);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->passes()) {
            $user = User::where([
                'email'=>$request->input('email'),
                'password'=>$this->encrypt_password($request->input('password')),
//                'status'=>1
            ])->first();
            if($user) {
                Auth::login($user);
                $response['status'] = "Success";
                $response['result'] = "Logged In";
            } else {
                $response['status'] = "Failure";
                $response['result'] = "Invalid email or password";
            }
        } else {
            $response['status'] = "Failure!";
            $response['result'] = $validator->errors()->toJson();
        }
        return response()->json($response);
    }
    public function save(Request $request){
        if($request->user_id){
            $validator = Validator::make($request->all(), [
                'full_name' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required',
            ]);
        }
        if($validator->passes()){
            if(isset($request->user_id)){
                User::where('user_id', $request->user_id)->update([
                    'full_name' => $request->full_name,
                ]);
            } else {
                $user = new User;
                $user->added_by = Auth::user()->user_id;
                $user->full_name = $request->full_name;
                $user->email = $request->email;
                $user->password = $this->encrypt_password($request->input('password'));
                $user->role_id = 2;
                $user->save();
            }
            $response['status'] = 'Success';
            $response['result'] = 'Added Successfully';
        } else{
            $response['status']= 'failure';
            $response['result'] = $validator->errors()->toJson();
        }
        return response()->json($response);
    }
    public function logout()
    {
        Auth::logout();
        Session::put('permissions', false);
        return redirect('login');
    }
    public function change_password(Request $request)
    {
        User::where('user_id', $request->user_id)->update([
            'password' => $this->encrypt_password($request->password)
        ]);
        $response['status'] = "Success";
        $response['result'] = "Password Updated Successfully";
        return response()->json($response);
    }
    public function change_pass(Request $request)
    {
        $check_curr_pass = User::where(['user_id'=>$request->user_id,
            'password'=>$this->encrypt_password($request->curr_password)])->count();
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'curr_password' => 'required'
        ]);
        if($validator->passes()) {
            if($check_curr_pass > 0){
                User::where('user_id', $request->user_id)->update([
                    'password' => $this->encrypt_password($request->password)
                ]);
                $response['status'] = "Success";
                $response['result'] = "Password Updated Successfully";
            }else{
                $response['status']= 'failure';
                $response['result'] = "Current Password doesn't Match";
            }
            return response()->json($response);
        }else{
            $response['status']= 'failure';
            $response['result'] = 'The password confirmation does not match.';
        }
        return response()->json($response);
    }
    function create_new_api_user(Request $request){
        $user = User::updateOrCreate(
            [
            'email' => $request->email,
            ],
            [
            'full_name' => $request->full_name,
            'customer_id' => $request->customer_id,
            'rate_per_application' => $request->rate_per_application,
            'allowable_payment' => $request->allowable_payment,
            'password' => $this->encrypt_password($request->password),
            'business_name' => $request->business_name,
            'role_id' => 2,
            'modified_on' => date('Y-m-d H:i:s')
        ]);
        $response['status'] = "Success";
        $response['user_id'] = $user->user_id;
        $response['result'] = "User added Successfully";
        return response()->json($response);
    }
    public function add_billing_user(Request $request){
        User::updateOrCreate(
            [
                'email' => $request->email,
            ],
            [
                'full_name' => $request->full_name,
                'password' => $this->encrypt_password($request->password),
                'role_id' => 3,
                'modified_on' => date('Y-m-d H:i:s')
            ]);
        $response['status'] = "Success";
        $response['result'] = "User added Successfully";
        return response()->json($response);
    }
    // encrypt password
    private function encrypt_password($password)
    {
        return sha1(md5($password . 'Looper$alt'));
    }
}
