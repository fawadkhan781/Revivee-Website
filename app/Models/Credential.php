<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    use HasFactory;

    protected $table = 'credentials';
    protected $primaryKey = 'credential_id';
    const CREATED_AT = 'added_on';
    const UPDATED_AT = 'modified_on';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'form_type',
        'group_name',
        'group_npi',
        'group_name',
        'group_tax_id',
        'practice_phone',
        'practice_fax',
        'email',
        'business_hours',
        'service_address',
        'billing_mailing_address',
        'mailing_address',
        'specialty',

        'provider_name',
        'provider_npi',
        'home_address',
        'license_number',
        'owner_dob',
        'ssn_number',

        'legal_name',
        'ein_tin',
        'medicare_group_ptan',
        'medicare_individual_ptan',
        'medicare_id',
        'start_date',
        'added_on',
        'modified_on',
        'parent_id',
        'check_address'
    ];
    public function insurances(){
        return $this->belongsToMany(Insurance::class,'user_insurances', 'credential_id', 'insurance_id')->withPivot('last_update_date', 'up_coming_date','insurance_status');
    }
    public function child_credentials()
    {
        return $this->hasMany(Credential::class,'parent_id');
    }
    public function user_insurances()
    {
        return $this->hasMany(UserInsurance::class,'credential_id','credential_id');
    }
    public function provider_practices()
    {
        return $this->hasMany(ProviderPractice::class, 'practice_id', 'credential_id');
    }
    //testing func providerPractices not in use
    public function providerPractices()
    {
        return $this->belongsToMany(ProviderPractice::class, 'provider_practices', 'credential_id', 'practice_id');
    }
    public function provider_practices_new()
    {
        return $this->hasMany(ProviderPractice::class, 'practice_id', 'credential_id');
    }

    public function logins(){
        return $this->hasOne(Login::class,'credential_id','credential_id');
    }
    public function credential_documents(){
        return $this->hasOne(CredentialingDocument::class,'credential_id','credential_id');
    }
    public function credential_statuses(){
        return $this->hasOne(CredentialStatus::class,'credential_id','credential_id');
    }
    public function login_statuses(){
        return $this->hasOne(LoginStatus::class,'credential_id','credential_id');
    }
    public function document_status(){
        return $this->hasOne(DocumentStatus::class,'credential_id','credential_id');
    }
    public function document_status_tab_view(){
        return $this->hasOne(DocumentStatusTabView::class,'credential_id','credential_id');
    }
    public function group_document_status_tab_view(){
        return $this->hasOne(GroupDocumentStatusTabView::class,'credential_id','credential_id');
    }
    public function group_status_tab(){
        return $this->hasOne(CredentialGroupStatusTabView::class,'credential_id','credential_id');
    }
    public function individual_status_tab(){
        return $this->hasOne(CredentialIndividualStatusTabView::class,'credential_id','credential_id');
    }
    public function login_status_tab_view(){
        return $this->hasOne(LoginStatusTabView::class,'credential_id','credential_id');
    }
    public function credential_indiviudal_status_count(){
        return $this->hasOne(CredentialIndividualStatusCountViewNew::class,'credential_id','credential_id');
    }
    public function credential_group_status_count(){
        return $this->hasOne(CredentialGroupStatusCountView::class,'credential_id','credential_id');
    }

}
