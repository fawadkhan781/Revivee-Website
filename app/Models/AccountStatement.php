<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class AccountStatement extends  Model
{
    protected $table = 'account_statements';
    public $timestamps = false;
//public function invoice_details(){
//    return $this->hasMany(InvoiceDetail::class,'id','invoice_id');
//}
//public function receipt_details(){
//    return $this->hasMany(ReceiptDetail::class,'id','receipt_id');
//}
}

