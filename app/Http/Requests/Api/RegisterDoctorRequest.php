<?php
namespace App\Http\Requests\Api;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterDoctorRequest extends BaseApiRequest
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
            'email' =>  'required|email',
            'password' => 'required|min:8|confirmed',
            'country_id' => ['nullable', 'exists:countries,id'],
            'phone_number' => ['nullable'],
            'image' => ['nullable', 'image', 'file', 'max:5120'],

            'academic_degree_id' => 'nullable|exists:academic_degrees,id',//optional
            'identity_proof' => ['nullable', 'image', 'file', 'max:5120'],
            'speciality_id' => 'nullable|exists:specialities,id',//optional
        ];
    }
}
