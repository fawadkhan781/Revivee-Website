<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class EscalationDetails extends Model
{
    protected $table = 'escalation_details';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'escalation_id',
        'reason',
        'added_by',
        'added_on',
        'status',
    ];
    
    public function escalation()
    {
        return $this->belongsTo(Escalation::class, 'escalation_id', 'escalation_id');
    }
}

