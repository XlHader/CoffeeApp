<?php

namespace App\Http\Requests\Category;

use Illuminate\Support\Facades\Log;
use App\Traits\JsonValidationResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryUpdateRequest extends FormRequest
{
    use JsonValidationResponse;

    protected $categoryId;

    public function __construct()
    {
        $this->categoryId = request()->route('category') ?? null;
    }

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
            'name' => ['required', 'string', 'min:3', 'max:255', Rule::unique('categories')->ignore($this->categoryId)->whereNull('deleted_at')]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'id.required' => 'The id field is required.',
            'id.integer' => 'The id field must be an integer.',
            'id.exists' => 'The id field must be exists.',
            'name.required' => 'The name field is required.',
            'name.string' => 'The name field must be a string.',
            'name.min' => 'The name field must be at least 3 characters.',
            'name.max' => 'The name field must be less than 255 characters.',
            'name.unique' => 'The name field must be unique.'
        ];
    }
}
