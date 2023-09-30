<?php
<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterPatientRequest extends BaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->where(function ($q) {
                    $q->where('email_unique',$this->get('email').'#-');
                })
            ],
            'password' => 'required|min:8|confirmed',
            'country_id' => ['nullable', 'exists:countries,id'],
            'phone_number' => ['nullable'],
            'image' => ['nullable', 'image', 'file', 'max:5120'],
        ];
    }
}
