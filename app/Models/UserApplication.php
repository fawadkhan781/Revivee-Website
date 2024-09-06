<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserApplication extends Model
{
    use HasFactory;
    protected $table='user_applications';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable=[
        'credential_id',
        'user_id',
        'insurance_id',
        'last_update_date',
        'up_coming_date',
        'insurance_status',
        'is_read',
        'is_paid',
        'assign_to',
        'agent_name'
    ];

    public function insurance()
    {
        return $this->belongsTo(Insurance::class, 'insurance_id','id');
    }
    public function credential()
    {
        return $this->belongsTo(Credential::class, 'credential_id','credential_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','user_id');
    }
    public function insurance_timeline()
    {
        return $this->hasMany(InsuranceTimeline::class,'user_application_id', 'id')->orderBy('created_at', 'DESC');
    }
}
