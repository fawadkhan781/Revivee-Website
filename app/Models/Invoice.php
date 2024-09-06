<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    use HasFactory;
    protected $table='invoices';

    protected $primaryKey='invoice_id';

    public $timestamps=false;

    protected $fillable=[
        'user_id',
        'title',
        'due_date',
        'total_amount',
        'discount',
        'added_on',
        'added_by',
        'added_by_name',
        'modified_on',
        'modified_by',
        'modified_by_name',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class, 'invoice_id', 'invoice_id');
    }
    public function receipt_amount()
    {
        return $this->hasMany(Receipt::class, 'invoice_id', 'invoice_id')
            ->select('invoice_id', DB::raw('sum(total_amount) as total_amount'))
            ->groupBy('invoice_id');
    }
    public function invoice_receipt(){
        return $this->hasOne(ReceiptInvoice::class,'invoice_id','invoice_id');
    }
    public function applications()
    {
        return $this->hasMany(InvoiceApplication::class, 'invoice_id', 'invoice_id');
    }
}