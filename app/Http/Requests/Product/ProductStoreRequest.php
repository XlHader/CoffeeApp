<?php

namespace App\Http\Requests\Product;

use App\Traits\JsonValidationResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductStoreRequest extends FormRequest
{
    use JsonValidationResponse;

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
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'reference' => ['required', 'max:255', Rule::unique('products')->whereNull('deleted_at')],
            'price' => ['required', 'integer', 'min:0'],
            'weight' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'integer', 'exists:categories,id,deleted_at,NULL'],
        ];
    }

    public function messages(): array {
        return [
            'refence.unique' => 'The reference must be unique, this one is already taken.',
            'price.integer' => 'The price must be an integer, you can\'t use decimals.',
            'weight.integer' => 'The weight must be an integer, you can\'t use decimals.',
            'category_id.required' => 'The category is required, you must select one.',
            'category_id.exists' => 'The category must exist, you must select one, this one doesn\'t exist.',
        ];
    }
}
