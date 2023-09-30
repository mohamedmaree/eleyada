<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;
use Str;
class ClinicRequest extends BaseApiRequest
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
            'name' => Str::contains($this->route()->getName(),['update']) ? 'nullable' : 'required',
            'phone_numbers.*' => 'nullable',
            'location_link' => 'nullable|url',
            'booking_link' => 'nullable|url',
            'address' => 'nullable|url',
            'images.*' => ['nullable', 'image', 'file', 'max:2048']
        ];
    }
}
