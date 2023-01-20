<?php

namespace App\Http\Requests\Leads;

use App\Services\Traits\ToBoolean;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class LeadCreateRequest extends FormRequest
{
    use ToBoolean;

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
        return [
            'company_id' => ["required", "exists:App\Models\Company,id"],
            'company_form_id' => ["required", "exists:App\Models\CompanyForm,id"],
            'user_id' => ["nullable", "exists:App\Models\User,id"],
            'ip_address' => ["nullable"],
            'user_agent' => ["nullable"],
            ...$this->getDynamicRules(),
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
            'company_id' => $this->form->company_id ?? null,
            'company_form_id' => $this->form->id ?? null,
            'user_id' => optional($this->user())->id,
            'ip_address' => $this->ip(),
            'user_agent' => Str::limit($this->userAgent(), 500, ' (...)'),
        ]);
    }

    /**
     * Загрузка данных о колонках формы и их правил валидации
     * 
     * @return array
     */
    public function getDynamicRules()
    {
        $rules = collect();

        collect(optional($this->form)->inputs)
            ->mapWithKeys(function ($input) {

                if ($input->attributes and $this->toBoolean($input->attributes->get('required'))) {
                    $rules[] = "required";
                } else {
                    $rules[] = "nullable";
                }

                $rules = $input->type->getValidationRules($rules, $input);

                return [$input->input_key => $rules];
            })
            ->each(function ($item, $key) use ($rules) {

                $rules->push(['key' => $key, 'rules' => $item]);

                foreach ($item as $row) {
                    if (is_array($row) and isset($row['key']) and isset($row['rules'])) {
                        $rules->push(
                            collect($row)->only(['key', 'rules'])
                        );
                    }
                }
            });

        return $rules->keyBy('key')
            ->map(function ($item) {
                return $item['rules'] ?? [];
            })
            ->toArray();
    }
}
