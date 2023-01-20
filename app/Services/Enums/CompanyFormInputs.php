<?php

namespace App\Services\Enums;

use Closure;

enum CompanyFormInputs: string
{
    case string = "string";
    case text = "text";
    case select = "select";
    case select_multiple = "select_multiple";
    case checkbox = "checkbox";
    case radio = "radio";

    /**
     * Наименование поля ввода
     * 
     * @return string
     */
    public function name()
    {
        return match ($this) {
            static::string => "Строка",
            static::text => "Многострочный текст",
            static::select => "Выпадающий список",
            static::select_multiple => "Множественный список",
            static::checkbox => "Чекбокс",
            static::radio => "Выбор",
            default => $this->name,
        };
    }

    /**
     * Выдает список типов полей
     * 
     * @return array
     */
    public static function options()
    {
        foreach (static::cases() as $case) {
            $options[] = [
                'value' => $case->value,
                'text' => $case->name(),
            ];
        }

        return $options ?? [];
    }

    /**
     * Формирует список для правила валидации in
     * 
     * @return string
     */
    public static function in()
    {
        foreach (static::cases() as $case) {
            $types[] = $case->value;
        }

        return implode(",", $types ?? []);
    }

    /**
     * Типы для которых обязателен список вариантов
     * 
     * @return string[]
     */
    public static function typesForOptions()
    {
        return [
            static::select->value,
            static::select_multiple->value,
            static::checkbox->value,
            static::radio->value,
        ];
    }

    /**
     * Формирует правила валидации для типа поля
     * 
     * @param  mixed  $rules
     * @param  \App\Models\CompanyFormInput|null  $input
     * @return array
     */
    public function getValidationRules($rules = [], $input = null)
    {
        $rules = collect($rules);

        $append = match ($this) {
            self::string, self::text => fn ($rules) => $rules->push('string'),
            self::select_multiple, self::checkbox => function ($rules, $input) {

                $append = [];

                if ($input->options) {

                    $in = collect($input->options)
                        ->map(function ($option) {
                            return $option['value'] ?? null;
                        })
                        ->filter(function ($item) {
                            return !is_null($item);
                        })
                        ->implode(",");

                    if ($in) {
                        $append[] = "in:" . $in;
                    }
                }

                return $rules->push(
                    collect(['key' => $input->input_key, 'rules' => [...$rules, "array"]]),
                    collect(['key' => $input->input_key . ".*", 'rules' => [...$rules, ...$append]]),
                );
            },
            self::select, self::radio => function ($rules, $input) {

                $append = [];

                if ($input->options) {

                    $in = collect($input->options)
                        ->map(function ($option) {
                            return $option['value'] ?? null;
                        })
                        ->filter(function ($item) {
                            return !is_null($item);
                        })
                        ->implode(",");

                    if ($in) {
                        $append[] = "in:" . $in;
                    }
                }

                return $rules->push(...$append);
            },
            default => null,
        };

        if ($append instanceof Closure) {
            $rules = call_user_func($append, $rules, $input);
        }

        return $rules->toArray();
    }
}
