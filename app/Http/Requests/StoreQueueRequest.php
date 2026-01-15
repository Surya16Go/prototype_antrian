<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Form Request untuk menyimpan antrian baru.
 */
class StoreQueueRequest extends FormRequest
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
            'passFoto' => ['required', 'in:on'],
            'fcKTP' => ['required', 'in:on'],
            'fcKK' => ['required', 'in:on'],
            'keperluan' => ['required', 'string', 'max:500'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'passFoto.required' => 'Pass Foto wajib dicentang',
            'passFoto.in' => 'Pass Foto wajib dicentang',
            'fcKTP.required' => 'Foto Copy KTP wajib dicentang',
            'fcKTP.in' => 'Foto Copy KTP wajib dicentang',
            'fcKK.required' => 'Foto Copy KK wajib dicentang',
            'fcKK.in' => 'Foto Copy KK wajib dicentang',
            'keperluan.required' => 'Keperluan wajib diisi',
            'keperluan.max' => 'Keperluan maksimal 500 karakter',
        ];
    }

    /**
     * Handle a failed validation attempt.
     * Returns JSON response for AJAX requests.
     */
    protected function failedValidation(Validator $validator): void
    {
        $errors = $validator->errors()->all();
        $missingFields = implode(', ', $errors);

        throw new HttpResponseException(
            response()->json([
                'message' => 'Tolong lengkapi persyaratan: '.$missingFields,
                'errors' => $validator->errors(),
            ], 400)
        );
    }
}
