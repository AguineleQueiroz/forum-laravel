<?php

namespace App\Http\Requests;

use App\Models\Support;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateSupport extends FormRequest
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
        return $this->isMethod('PATCH') ? [
            'subject' => Rule::unique(Support::class, 'subject')->ignore($this->id),
        ] : [
            'subject' => 'required|min:3|max:255|unique:supports',
            'content' => [
                'required',
                'min:3',
                'max:2000',
            ]
        ];
    }
}