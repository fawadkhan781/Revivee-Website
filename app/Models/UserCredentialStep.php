<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCredentialStep extends Model
{
    use HasFactory;
    protected $table='user_credential_steps';

    protected $primaryKey='id';

    public $timestamps=false;

    protected  $fillable=[
      'credential_id',
      'step',
      'is_approved',
    ];
}
