<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreCompanyRequest extends FormRequest
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
        return [
            'name' => ["required", "string", "max:50"],
            'slug' => ["nullable", "string", "unique:App\Models\Company,slug"],
            'description' => ["nullable", "string", "max:255"],
            'is_active' => ["nullable", "boolean"],
            'user_id' => ["required"],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->exists('name')) {
            $this->merge(['slug' => Str::slug($this->name)]);
        }

        if ($this->exists('is_active')) {
            $this->merge(['is_active' => $this->boolean('is_active')]);
        }

        $this->merge(['user_id' => $this->user()->id]);
    }
}
