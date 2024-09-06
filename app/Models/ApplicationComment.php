<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationComment extends Model
{
    use HasFactory;
    protected $table = 'application_comments';
    protected $primaryKey = 'id';
    const CREATED_AT = 'added_on';
    const UPDATED_AT = 'modified_on';

    protected $fillable=[
        'application_id',
        'comment',
        'added_on',
        'added_by_name',
        'modified_on',
        'modified_by_name',
    ];
}
