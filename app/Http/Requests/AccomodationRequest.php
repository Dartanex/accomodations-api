<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class AccomodationRequest extends FormRequest
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
            'name' => 'required|string',
            'address' => 'required|string',
            "capacity" => "required|numeric",
            "rooms" => "required|numeric",
            "image_url" => "required|string",
            "price" => "required|numeric",
            "description" => "required|string",
        ];
    }

    protected function failedValidation(Validator $validator){
        $response = response()->json([
            'status' => false,
            'message' => 'Validation erros',
            'erros' => $validator->errors()
        ], 409);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
