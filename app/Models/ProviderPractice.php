<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ProviderPractice extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'provider_practices';
    protected $primaryKey = 'id';
    const CREATED_AT = 'added_on';
    const UPDATED_AT = 'modified_on';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider_id',
        'practice_id',
        'status'
    ];

    public function practice(){
        return $this->belongsTo(Credential::class, 'practice_id', 'credential_id');
    }
    //testing func credentials not in use

    public function credentials()
    {
        return $this->belongsToMany(Credential::class, 'provider_practices', 'practice_id', 'credential_id');
    }
    public function credential()
    {
        return $this->belongsTo(Credential::class, 'practice_id', 'credential_id');
    }
    public function provider(){
        return $this->belongsTo(Credential::class, 'provider_id', 'credential_id');
    }

}
