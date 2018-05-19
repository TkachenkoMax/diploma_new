<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreUserAccountInformation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user() === Auth::user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname'     => 'required|max:255',
            'lastname'      => 'required|max:255',
            'date_of_birth' => 'nullable|date_format:d/m/Y',
            'sex'           => 'nullable', Rule::in([null, 0, 1]),
            'phone_number'  => 'nullable|regex:/[(][0]\d{2}[)][-]\d{3}[-]\d{2}[-]\d{2}/',
            'address'       => 'nullable|max:200',
            'work_place'    => 'nullable|max:200',
            'work_position' => 'nullable|max:200',
        ];
    }
}
