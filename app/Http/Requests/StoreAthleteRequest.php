<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAthleteRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'code'            => 'nullable|string|max:255',
        'name'            => 'required|string|max:255',
        'birthdate'       => 'required|date|date_format:Y-m-d',
        'document_number' => [
            'required',
            'string',
            'max:14',
            'regex:/\d{3}[\.]?\d{3}[\.]?\d{3}[\-]?\d{2}/i',
        ],
        'team'            => 'required|string|max:255',
        'belt'            => 'required|string|max:255|in:brown,black',
        'gender'          => 'required|string|max:255|in:male,female',
        'weight'          => 'required|string|max:255|in:light,strong',
        'email'           => 'required|string|max:255|email',
        'password'        => 'required|string|confirmed|min:8|max:255|',
        ];
    }
}
