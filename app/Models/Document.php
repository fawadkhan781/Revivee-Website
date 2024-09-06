<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table = 'documents';
    protected $primaryKey = 'doc_id';
    public $timestamps = false;

    protected  $fillable=[
        'doc_id',
        'title',
        'docs_files',
        'added_on',
        'added_by',
    ];

    public function user_documents()
    {
        return $this->hasMany(UserDocument::class, 'doc_id', 'doc_id');
    }
}
