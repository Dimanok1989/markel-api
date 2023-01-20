<?php

namespace App\Http\Requests\Leads;

class LeadUpdateRequest extends LeadCreateRequest
{
    /**
     * Данные формы ввода
     * 
     * @var \App\Models\CompanyForm
     */
    public $form;

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
        return collect(parent::rules())
            ->except([
                'company_id',
                'company_form_id',
                'user_id',
                'ip_address',
                'user_agent'
            ])
            ->all();
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->form = optional($this->lead)->form;

        parent::prepareForValidation();
    }
}
