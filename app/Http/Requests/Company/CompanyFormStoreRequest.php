<?php

namespace App\Http\Requests\Company;

use App\Models\CompanyForm;
use Illuminate\Foundation\Http\FormRequest;

class CompanyFormStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('view', $this->company)
            && $this->user()->can('create', CompanyForm::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'company_id' => ["required", "exists:App\Models\Company,id"],
            'name' => ["required", "string", "max:100"],
            'description' => ["nullable", "string", "max:255"],
            'is_active' => ["nullable", "boolean"],
            'is_public' => ["nullable", "boolean"],
            'sorting' => ["nullable", "integer"],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
            'is_public' => $this->boolean('is_public'),
            'sorting' => $this->input('sorting') ?: CompanyForm::nextSortingPosition($this->company_id),
        ]);
    }
}
