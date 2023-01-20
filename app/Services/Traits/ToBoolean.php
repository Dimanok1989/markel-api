<?php

namespace App\Services\Traits;

trait ToBoolean
{
    /**
     * Retrieve input as a boolean value.
     * Returns true when value is "1", "true", "on", and "yes". Otherwise, returns false.
     *
     * @param  string|null  $value
     * @return bool
     */
    public function toBoolean($value = null)
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}