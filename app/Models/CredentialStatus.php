<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CredentialStatus extends Model
{
    use HasFactory;
    const CREATED_AT = 'added_on';
    const UPDATED_AT = 'modified_on';
    protected  $guarded=[];
}
