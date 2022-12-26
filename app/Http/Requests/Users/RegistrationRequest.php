<?php

namespace App\Http\Requests\Users;

use App\Services\Phones\PhoneServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegistrationRequest extends FormRequest
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
            'firstname' => ["required", "string", "min:1", "max:255"],
            'lastname' => ["nullable", "string", "min:1", "max:255"],
            'patronymic' => ["nullable", "string", "min:1", "max:255"],
            'name' => ["required", "string", "min:1", "max:255"],
            'email' => ["required_without:phone", "email", "unique:users,email"],
            'phone' => ["required_without:email", "unique:users,phone"],
            'password' => ["required", "confirmed", Password::min(8)->letters()->numbers()->mixedCase()],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $merge = [];

        if ($this->exists('phone')) {
            $phone = app(PhoneServiceInterface::class)->getPhone($this->phone);
            $merge['phone'] = $phone ?: $this->phone;
        }

        $name = trim(implode(" ", [
            (string) $this->lastname,
            (string) $this->firstname,
            (string) $this->patronymic,
        ]));

        if ((bool) $name) {
            $merge['name'] = $name;
        }

        if ($merge) {
            $this->merge($merge);
        }
    }
}
