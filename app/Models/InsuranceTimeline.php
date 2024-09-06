<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceTimeline extends Model
{
    use HasFactory;
    protected  $table='insurance_timelines';
    protected  $primaryKey='id';
    public $timestamps=false;

    protected $fillable=[
      'user_application_id',
      'message',
      'created_at',
      'insurance_status'
    ];
    public function user_application()
    {
        return $this->belongsTo(UserApplication::class, 'user_application_id','id');
    }
}
