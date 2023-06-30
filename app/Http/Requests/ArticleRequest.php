<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => ['required', 'max:100'],
            'written_by' => ['required','string'],
            'image' => ['nullable', 'image'],
            'fan_types_id' => ['required', 'integer'],
            'content' => ['nullable', 'string','max:4000'],
        ];
    }
}
