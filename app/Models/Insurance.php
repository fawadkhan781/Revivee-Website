<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;
    protected $table='insurances';

    protected $fillable=[
        'title'
    ];
    public function user_insurances(){
        return $this->hasMany(UserInsurance::class, 'id', 'insurance_id');
    }
    public function insurance_timeline(){
        return $this->belongsToMany(Credential::class,'insurance_timelines', 'insurance_id', 'credential_id');
    }
}
