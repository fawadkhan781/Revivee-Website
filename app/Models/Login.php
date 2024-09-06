<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;
    protected $table = 'logins';
    protected $primaryKey = 'id';
    const CREATED_AT = 'added_on';
    const UPDATED_AT = 'modified_on';

    protected  $fillable=[
        'credential_id',
        'user_id',
        'nppes_username',
        'nppes_password',
        'caqh_username',
        'caqh_password',
        'provider_source_username',
        'provider_source_password',
        'availity_state',
        'availity_username',
        'availity_password',
        'uhc_username',
        'uhc_password',
        'parent_id',
        'added_on',
        'modified_on',
    ];
}
