<?php

namespace App\Http\Requests\v1\Market;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'market_name' => ['required', 'string'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'location_x' => ['required', 'integer', 'min:0'],
            'location_y' => ['required', 'integer', 'min:0'],
        ];
    }
}
