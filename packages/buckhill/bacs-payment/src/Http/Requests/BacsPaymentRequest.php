<?php

namespace Buckhill\BacsPayment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BacsPaymentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // VOL1 data validation
            'vol.owner_id' => ['required', 'string', 'in:HSBC,SAGE,BACS'],
            'vol.owner_id_no' => ['required_if:vol.owner_id,BACS', 'digits:2', 'numeric'],

            // HDR1 data validation
            'hdr1.file_creation_date' => 'required|date_format:m/d/Y',
            'hdr1.file_expiration_date' => 'required|date_format:m/d/Y|after:hdr1.file_creation_date',
        ];
    }
}
