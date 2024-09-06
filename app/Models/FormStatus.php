<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormStatus extends Model
{
    use HasFactory;

    protected  $table='form_status';

    protected  $primaryKey='id';

    public  $timestamps=false;

    protected  $fillable=[
        'credential_id',
        'field_name',
        'status',
        'reject_message'
    ];
}
