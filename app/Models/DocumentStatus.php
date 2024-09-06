<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentStatus extends Model
{
    use HasFactory;
    const CREATED_AT = 'added_on';
    const UPDATED_AT = 'modified_on';

    protected  $fillable=[
        'credential_id',
        'state_license_image',
        'state_license_image_message',
        'accreditation_image',
        'accreditation_image_message',
        'irs_letter_image',
        'irs_letter_image_message',
        'professional_liability_insurance_image',
        'professional_liability_insurance_image_message',
        'driver_license_image',
        'driver_license_image_message',
        'w9_form_image',
        'w9_form_image_message',
        'additional_document_image',
        'additional_document_image_message',
        'resume_image',
        'resume_image_message',
        'degree_image',
        'degree_image_message',
        'board_certification_image',
        'board_certification_image_message',
        'bank_letter_image',
        'bank_letter_image_message'
    ];
}
