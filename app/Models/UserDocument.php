<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    use HasFactory;
    protected $table = 'user_documents';
    protected $primaryKey = 'doc_id';
    public $timestamps = false;

    protected  $fillable=[
        'user_id',
        'title',
        'docs_files',
        'added_on',
        'added_by',
        'added_by_name',
    ];
}
