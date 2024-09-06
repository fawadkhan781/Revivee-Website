<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptInvoice extends Model
{
    use HasFactory;
    protected $table="receipt_invoices";
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable=[
        'id',
        'receipt_id',
        'invoice_id',
    ];

    public function receipt() {
        return $this->belongsTo(Receipt::class, 'receipt_id', 'receipt_id');
    }

    public function invoice() {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'invoice_id');
    }
}
