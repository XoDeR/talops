<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !!$this->user() /*&& $this->user()->can('create', Company::class)*/;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'between:3,255',
            ],
            'email' => [
                'nullable',
                'email',
                Rule::unique('companies', 'email')->ignore($this->company->id),
            ],
            'address' => [
                'nullable',
                'string',
                'between:3,1024',
            ],
            'website' => [
                'nullable',
                'string',
                'between:3,255',
            ],
            'logo_uuid' => [
                'nullable',
                'string',
                'uuid',
            ],
            'employee_uuid.*' => [
                'nullable',
                'exists:employees,uuid',
            ],
        ];
    }
}
