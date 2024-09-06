<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CredentialingDocument extends Model
{
    use HasFactory;
    protected $table = 'credentialing_documents';
    protected $primaryKey = 'id';
    const CREATED_AT = 'added_on';
    const UPDATED_AT = 'modified_on';

    protected  $fillable=[
        'credential_id',
        'user_id',
        'state_license_image',
        'accreditation_image',
        'irs_letter_image',
        'bank_letter_image',
        'professional_liability_insurance_image',
        'driver_license_image',
        'w9_form_image',
        'resume_image',
        'degree_image',
        'additional_document_image',
        'board_certification_image',
        'parent_id',
        'added_on',
        'modified_on',
    ];
}
