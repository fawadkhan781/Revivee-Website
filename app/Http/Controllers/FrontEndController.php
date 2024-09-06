<?php
namespace App\Http\Controllers;
use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactUs;
use App\Models\User;
class FrontEndController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function index()
    {
        $data['page_title'] = "Atlantis RCM";
        return view('front_end.index',$data);
    }

    public function contact_us_form_save(Request $request)
    {
//                dd($request->all());
        $validator = Validator::make($request->all(),[
            'contact_for' => 'bail|required',
            'specialty' => 'bail|required',
            'name' => 'bail|required',
            'email' => 'bail|required',
            'phone' => 'bail|required',
            'subject' => 'bail|required',
            'message' => 'bail|required',
        ]);
        if ($validator->passes()) {
            // send mail
            $data = [
                'contact_for' => $request->contact_for,
                'specialty' => $request->specialty,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'opt_in_out' => $request->opt_in_out,
            ];
            try{
                $details = [
                    'contact_for' => $request->contact_for,
                    'specialty' => $request->specialty,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'subject' => $request->subject,
                    'message' => $request->message,
                    'opt_in_out' => $request->opt_in_out
                ];

                Mail::to('sajjad.akbar@atlantisbpo.com')->send(new ContactUsMail($details));

//                dd("Email is Sent.");
//                $contact_name = $request->name;
//                $contact_email = $request->email;
//                $subject = "Subject: ".$request->subject;
//                $subject = $subject. "\r\n" ."Phone#: ".$request->phone;
//                $message = $subject . "\r\n"."Looking For:" . $request->contact_for;
//                $message = $message . "\r\n"."Specialty:" . $request->specialty;
//                $message = $message . "\r\n"."Subject:" . $request->message;
//                $subject = "AtlantisRCM Contact Form";
                // Email header
//                $headers[] = 'MIME-Version: 1.0';
//                $headers[] = 'Content-type: text/html; charset=utf-8';
//                $headers[] = "To: sajjad.akbar@atlantisbpo.com";
//                $headers[] = "From: ".$contact_email;

//                $headers[] =  'MIME-Version: 1.0' . "\r\n";
//                $headers[] .= 'From: Your name <sajjad.akbar@atlantisbpo.com>' . "\r\n";
//                $headers[] .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//                $header = implode('\r\n', $headers);
//                dd($headers, $subject, $message);
//                mail('sajjad.akbar@atlantisbpo.com', $subject, $message, $headers);
//                echo "Success";
            } catch (Exception $ex){
//                echo "Failure";
            }
//            ContactUs::Create($data);
            $response['status'] = "Success";
            $response['result'] = 'An expert will get back to you ASAP!';
        } else {
            $response['status'] = "Failure!";
            $response['result'] = $validator->errors()->toJson();
        }
        return response()->json($response);
    }
    public function contact_us_form_data(Request $request){

        $validator = Validator::make($request->all(),[
            'contact_for' => 'bail|required',
            'specialty' => 'bail|required',
            'name' => 'bail|required',
            'email' => 'bail|required|unique:contact_us',
            'phone' => 'bail|required',
            'subject' => 'bail|required',
            'message' => 'bail|required',
        ]);
        if ($validator->passes()) {
            // send mail
            $opt_in_out=$request->opt_in_out;
            if($request->opt_in_out==null){
                $opt_in_out=0;
            }
            try{
                $details = [
                    'contact_for' => $request->contact_for,
                    'specialty' => $request->specialty,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'subject' => $request->subject,
                    'message' => $request->message,
                    'opt_in_out' => $opt_in_out,
                    'added_on' => date('Y-m-d H:i:s')
                ];
                Mail::to('info@atlantisrcm.com')->send(new ContactUsMail($details));
                ContactUs::insert($details);
            } catch (Exception $ex){
//                echo "Failure";
            }
//            ContactUs::Create($data);
            $response['status'] = "Success";
            $response['result'] = 'An expert will get back to you ASAP!';
        } else {
            $response['status'] = "Failure!";
            $response['result'] = $validator->errors()->toJson();
        }
        return response()->json($response);
    }

}
