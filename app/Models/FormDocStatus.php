<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class FormDocStatus extends  Model
{
    protected $table = 'customer_document_status';
    public $timestamps=false;
    protected $fillable=[
        "credential_id",
        "document_name",
        "reject_message",
        "status",
    ];
}
