<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChampionshipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->role == 'admin';
    }

    public function rules(): array
    {
        return [
            'code'            => 'required|string|max:255',
            'title'           => 'required|string|max:255',
            'image'           => 'nullable|string|max:255',
            'state_id'        => 'required|exists:states,id',
            'city_id'         => 'required|exists:cities,id',
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
