<?php

namespace App\Http\Controllers;

use App\Models\BillingDocument;
use App\Models\BillingFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use PHPUnit\Exception;

class BillingController extends Controller
{
    public function billing_user_dashboard(){
        $data['year']=date('Y',strtotime(get_date_time()));
        $data['month']=date('F',strtotime(get_date_time()));
        return view('front_end.user.billing_user_dashboard',$data);
    }
    public function billing_folders(Request $request){
         $date=cal_days_in_month(CAL_GREGORIAN, $request->month, $request->year);
         for ($x = 0; $x <= $date-1; $x++){
             $day[]=$x+1;
         }
        $data['days']=$day;
         $data['month']=$request->month;
        return view('front_end.user.partials.billing_folders',$data);
    }
    public function billing_documents(Request $request){
        $data['day']=$request->day;
        $data['month']=$request->month;
        $data['billing_documents']=BillingFolder::with('billing_document')
            ->where('title',$request->day)
            ->where('month',$request->month)
            ->where('year',$request->year)
            ->where('status',1)
            ->where('user_id',Auth::user()->user_id)
            ->first();
        return view('front_end.user.partials.billing_documents',$data);
    }
    public function create_billing_documents(Request $request){
        $validator=validator::make($request->all(),[
            'document_file'=>'required'
        ]);
        if ($validator->passes()){
            $billing_folder=BillingFolder::updateOrCreate(
                [   'title'=>$request->day,
                    'month'=>$request->month,
                    'year'=>$request->year],
                [   'user_id'=>Auth::user()->user_id]);
            $file=$request->file('document_file');
            $file_name= time().rand(0,100).'.'.$file->extension();
            $file->move(public_path('billing_documents'),$file_name);
            $billing_folder->billing_document()->create(['document_file'=>$file_name]);
            $response['status']='success';
            $response['result']='Document uploaded Successfully';
        }else{
            $response['status']='Failure';
            $response['result']=$validator->errors()->toJson();
        }
        return response()->json($response);
    }
    public function delete_document(Request $request){
        try {
            $doc=BillingDocument::where('id',$request->id)->first();
            $doc->delete();
            File::delete(public_path('billing_documents/'.$doc->document_file));
            $response['status']='success';
            $response['result']='Document Deleted Successfully';
        }catch (Exception $exception){
            $response['status']='Failure';
            $response['result']=$exception->getMessage();
        }
        return response()->json($response);
    }
}
