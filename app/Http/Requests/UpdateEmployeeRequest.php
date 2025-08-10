<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
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
            'first_name' => [
                'required',
                'string',
                'between:3,255',
            ],
            'last_name' => [
                'required',
                'string',
                'between:3,255',
            ],
            'email' => [
                'nullable',
                'email',
                Rule::unique('employees', 'email')->ignore($this->employee->id),
            ],
            'phone' => [
                'nullable',
                'string',
                'between:3,255',
            ],
            'company_uuid' => [
                'nullable',
                'string',
                'uuid',
            ],
        ];
    }
}
