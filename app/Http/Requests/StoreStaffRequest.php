<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStaffRequest extends FormRequest
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
            'full_name_ka' => 'required',
            'full_name_en' => 'required',
            'position_ka' => 'required',
            'position_en' => 'required',
            'email' => 'nullable',
            'image' => 'nullable|file|max:2050',
        ];
    }
}
