<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChampionshipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->role == 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'           => 'required|string|max:255',
            'image'           => 'nullable|file',
            'date'            => 'required|date|max:255',
            'about'           => 'required|string|max:255',
            'gym_place'       => 'required|string|max:255',
            'info'            => 'required|string|max:255',
            'public_entrance' => 'nullable|string|max:255',
            'type'            => 'required|in:kimono,no-gi',
            'phase'           => 'required|in:open_register,fighting,finished',
        ];
    }
}
