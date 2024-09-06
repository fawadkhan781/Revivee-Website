<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingFolder extends Model
{
    use HasFactory;
    protected $table = 'billing_folders';
    protected $primaryKey = 'id';
    const CREATED_AT = 'added_on';
    const UPDATED_AT = 'modified_on';
    protected $fillable=[
      'user_id',
      'year',
      'month',
      'title',
      'status'
    ];
    public function billing_document(){
        return $this->hasMany(BillingDocument::class,'billing_folder_id','id');
    }
}
