<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\DataAwareRule;

class FormInputAttributes implements Rule, DataAwareRule
{
    /**
     * All of the data under validation.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Messages
     *
     * @var array
     */
    protected $messages = [];

    /**
     * Attribute keys
     * 
     * @var array
     */
    protected $attribute_keys = [
        'required',
        'min',
        'max',
        'step',
        'rows',
    ];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Set the data under validation.
     *
     * @param  array  $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!is_array($value)) {
            $this->messages[] = "Атрибуты должны быть переданы в виде массива.";
        } else {

            foreach ($value as $key => $row) {
                if (!in_array($key, $this->attribute_keys)) {
                    $this->messages[] = "Атрибут {$key} не входит в список разрешенных атрибутов.";
                }
            }
        }

        return count($this->messages) == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return array
     */
    public function message()
    {
        return $this->messages;
    }
}
