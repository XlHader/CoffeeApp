<?php

namespace App\Http\Requests\Product;

use Illuminate\Validation\Rule;
use App\Traits\JsonValidationResponse;
use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    use JsonValidationResponse;

    protected $productId;

    public function __construct()
    {
        $this->productId = request()->route('product');
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
            'name' => ['string', 'min:3', 'max:255'],
            'reference' => ['max:255', Rule::unique('products')->ignore($this->productId)->whereNull('deleted_at')],
            'price' => ['integer', 'min:0'],
            'weight' => ['integer', 'min:0'],
            'stock' => ['integer', 'min:0'],
            'category_id' => ['integer', 'exists:categories,id,deleted_at,NULL'],
        ];
    }

    public function messages(): array {
        return [
            'refence.unique' => 'The reference must be unique, this one is already taken.',
            'price.integer' => 'The price must be an integer, you can\'t use decimals.',
            'weight.integer' => 'The weight must be an integer, you can\'t use decimals.',
        ];
    }
}
