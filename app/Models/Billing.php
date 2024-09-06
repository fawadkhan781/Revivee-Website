<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $table = 'billings';
    protected $primaryKey = 'billing_id';
    const CREATED_AT = 'added_on';
    const UPDATED_AT = 'modified_on';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'group_name',
        'group_npi',
        'legal_name',
        'ein_tin',
        'owner_dob',
        'provider_name',
        'provider_npi',
        'service_address',
        'billing_mailing_address',
        'start_date',
        'medicare_group_ptan',
        'medicare_individual_ptan',
        'sftlg_username',
        'sftlg_password',
        'wbplg_username',
        'wbplg_password',
        'billing_type',
        'ssn',
        'medicare_id',
        'insurance_network_list',
        'additional_note',
        'document_name',
        'document_file'
    ];
    public function billing_documents(){
        return $this->hasMany(BillingDocument::class, 'billing_id', 'billing_id');
    }
}
