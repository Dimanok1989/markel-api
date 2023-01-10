<?php

namespace App\Http\Requests\Company\Inputs;

class CompanyFormInputUpdateRequest extends CompanyFormInputCreateRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return array_filter(
            parent::rules(),
            fn ($k) => !in_array($k, [
                'company_form_id',
                'sorting'
            ]),
            ARRAY_FILTER_USE_KEY
        );
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
        ]);
    }
}
