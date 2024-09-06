<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Escalation extends Model
{
    protected $table = 'escalation';
    protected $primaryKey = 'escalation_id';
    public $timestamps = false;

    protected $fillable = [
        'customer_id',
        'added_by',
        'start_date',
        'end_date',
        'escalation_status',
        'status',
    ];

    public function details()
    {
        return $this->hasMany(EscalationDetails::class, 'escalation_id', 'escalation_id');
    }
}
