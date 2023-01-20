<?php

namespace App\Http\Requests\Company\Inputs;

use App\Models\CompanyFormInput;
use App\Rules\FormInputAttributes;
use App\Services\Enums\CompanyFormInputs;
use Illuminate\Foundation\Http\FormRequest;

class CompanyFormInputCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->form)
            && $this->user()->can('create', CompanyFormInput::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'company_form_id' => ["required", "exists:App\Models\CompanyForm,id"],
            'name' => ["required", "string", "min:1", "max:50"],
            'description' => ["nullable", "string", "max:255"],
            'type' => ["required", "in:" . CompanyFormInputs::in()],
            'attributes' => [new FormInputAttributes],
            'options' => ["required_if:type," . implode(",", CompanyFormInputs::typesForOptions()), "array"],
            'options.*' => ["nullable", "array:text,value"],
            'is_active' => ["nullable", "boolean"],
            'is_public' => ["nullable", "boolean"],
            'sorting' => ["nullable"],
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
            'company_form_id' => $this->form->id ?? null,
            'is_active' => $this->boolean('is_active'),
            'is_public' => $this->boolean('is_public'),
            'sorting' => $this->input('sorting') ?: CompanyFormInput::nextSortingPosition($this->form->id ?? null),
        ]);
    }
}
