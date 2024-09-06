<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCard extends Model
{
    use HasFactory;
    protected $table="user_cards";
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable=[
        'user_id',
        'full_name',
        'card_number',
        'exp_date',
        'cvv',
        'added_on',
        'modified_on'
    ];
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

}
