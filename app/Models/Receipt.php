<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;
    protected $table="receipts";
    protected $primaryKey = 'receipt_id';
    public $timestamps = false;

    protected $fillable=[
        'user_id',
        'invoice_id',
        'transaction_id',
        'title',
        'receipt_date',
        'total_amount',
        'customer_id',
        'added_by',
        'added_by_name',
        'added_on',
        'modified_by',
        'payment_status',
        'modified_on'
    ];

    public function receipt_added_by() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function invoice() {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'invoice_id');
    }
    public function receipt_invoice_details(){
        return $this->hasMany(ReceiptInvoice::class, 'receipt_id', 'receipt_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

}
