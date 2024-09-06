<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    const CREATED_AT = 'added_on';
    const UPDATED_AT = 'modified_on';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'role_id',
        'credential_assign',
        'allowable_payment',
        'rate_per_application',
        'customer_id',
        'business_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'added_on' => 'datetime',
    ];

    public function rules()
    {
        return [
            'name' => 'required',
            'username' => 'required|min:8',
            'email' => 'required|email|unique:users,email,'.$this->user->id
        ];
    }
    public function group_credential(){
        return $this->hasMany(Credential::class, 'user_id', 'user_id')->where('form_type','credentialing_agencies');
    }
    public function user_card(){
        return $this->hasOne(UserCard::class, 'user_id', 'user_id');
    }
    public function user_billing(){
        return $this->hasMany(BillingFolder::class, 'user_id', 'user_id')
            ->orderBy('year', 'DESC')
            ->orderBy('month', 'ASC')
            ->orderByRaw('cast(title as int) ASC');
    }
}
