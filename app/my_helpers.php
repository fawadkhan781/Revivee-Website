<?php
use App\Models\FormDocStatus;
use App\Models\UserCredentialStep;

if(!function_exists('user_doc_status')){
    function user_doc_status($credential_id,$doc_name)
    {
        return FormDocStatus::whereCredentialId($credential_id)->where('document_name', $doc_name)->first();
    }
}
if (!function_exists('get_date_time')) {
    function get_date_time()
    {
        $tz_object = new DateTimeZone('Asia/Karachi');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        return $datetime->format('Y\-m\-d\ H:i:s');
    }
}
//Eastern Time Zone
if (!function_exists('eastern_date_time')) {
    function eastern_date_time()
    {
        $tz_object = new DateTimeZone('US/Eastern');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        return $datetime->format('Y\-m\-d\ H:i:s');
    }
}
if(!function_exists('step')){
    function step($credential_id,$step)
    {
        return UserCredentialStep::whereCredentialId($credential_id)->where('step', $step)->first();
    }
}
