<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInsuranceApplicationView extends Model
{
    use HasFactory;
    protected $table='user_insurance_applicaion_view';

    public function insurance()
    {
        return $this->belongsTo(Insurance::class, 'insurance_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','user_id');
    }
}
