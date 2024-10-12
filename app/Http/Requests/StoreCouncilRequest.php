<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouncilRequest extends FormRequest
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
            'first_name_ka' => 'required|string|min:3|max:100',
            'first_name_en' => 'required|string|min:3|max:100',
            'last_name_ka' => 'required|string|min:3|max:100',
            'last_name_en' => 'required|string|min:3|max:100',
            'representative_ka' => 'required|string|min:3',
            'representative_en' => 'required|string|min:3'
        ];
    }
}
