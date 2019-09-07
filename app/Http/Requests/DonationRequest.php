<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonationRequest extends FormRequest
{

    protected $postRules = [
        'donationType' => 'required|string',
        'emailAddress' => 'required|email',
        'fullName' => 'required|string',
        'paymentType' => 'required|string',
        'donationAmount' => 'required|numeric',

    ];
    protected $patchRules = [
        'giftaid' => 'boolean',
    ];

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
        if ($this->isMethod('POST')) {
            return $this->postRules;
        }
        if ($this->isMethod('PATCH')) {
            return $this->patchRules;
        }
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
