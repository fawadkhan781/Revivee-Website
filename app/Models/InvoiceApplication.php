<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceApplication extends Model
{
    use HasFactory;
    protected $table='invoice_applications';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable=[
        'invoice_id',
        'application_id',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id','invoice_id');
    }
    public function application()
    {
        return $this->belongsTo(UserApplication::class, 'application_id','id');
    }
}
