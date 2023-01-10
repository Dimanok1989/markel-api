<?php

namespace App\Services\Enums;

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
}
