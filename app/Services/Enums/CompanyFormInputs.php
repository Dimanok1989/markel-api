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
     * Выдает список типов полей
     * 
     * @return array
     */
    public static function options()
    {
        foreach (static::cases() as $case) {
            $options[] = [
                'value' => $case->value,
                'text' => $case->name,
            ];
        }

        return $options ?? [];
    }
}