<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'donationType' => 'required|string',
            'emailAddress' => 'required|email',
            'fullName' => 'required|string',
            'paymentType' => 'required|string',
            'donationAmount' => 'required|numeric',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'fullName.required' => 'Come on - give me your name',
        ];
    }
}
