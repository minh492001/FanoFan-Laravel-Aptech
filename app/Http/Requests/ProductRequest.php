<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:1000'],
            'product_code' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'video' => ['nullable', 'max:1000000000'],
            'type_id' => ['required', 'integer'],
            'brand_id' => ['required', 'integer'],
            'technical_id' => ['required', 'integer'],
            'description' => ['nullable', 'string', 'max:6000'],
            'about' => ['nullable', 'string', 'max:6000'],
        ];
    }
}
