<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class UserInsurance extends Model
{
    use HasFactory;

    protected $table = 'user_insurances_new';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'insurance_id',
        'added_by',
        'added_on',
        'status'
    ];

    public function insurance()
    {
        return $this->belongsTo(Insurance::class, 'insurance_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function user_applications()
    {
        return $this->hasMany(UserApplication::class, 'insurance_id', 'insurance_id')
            ->where('user_id', $this->user_id);
    }
    public function insurance_timeline()
    {
        return $this->hasMany(InsuranceTimeline::class,'user_insurance_id')->orderBy('id', 'DESC');
    }
}
