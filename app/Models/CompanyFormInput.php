<?php

namespace App\Models;

use App\Services\Enums\CompanyFormInputs as Types;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyFormInput extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_form_id',
        'name',
        'description',
        'type',
        'attributes',
        'options',
        'is_active',
        'is_public',
        'sorting',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'type' => Types::class,
        'attributes' => AsCollection::class,
        'options' => AsArrayObject::class,
        'is_active' => 'boolean',
        'is_public' => 'boolean',
    ];

    /**
     * Идентификатор поля ввода
     * 
     * @return string
     */
    public function getInputKeyAttribute()
    {
        return "input_" . $this->id;
    }

    /**
     * Форма компании, к которой принадлежит поле ввода
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function form()
    {
        return $this->hasOne(CompanyForm::class, 'id');
    }

    /**
     * Данные заявки, принадлежащие полю ввода
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function data()
    {
        return $this->hasOne(LeadData::class, 'input_id');
    }

    /**
     * Данные поля ввода по заявки
     * 
     * @param  int  $lead_id
     * @return \App\Models\LeadData
     */
    public function dataFromLead(int $lead_id)
    {
        return $this->data()->firstOrNew(['lead_id' => $lead_id]);
    }

    /**
     * Значение данных по заявке
     * 
     * @param  int  $lead_id
     * @return mixed
     */
    public function getValueFromLead(int $lead_id)
    {
        $value = $this->dataFromLead($lead_id)->value ?? null;

        $variable = match ($this->type) {
            Types::select_multiple, Types::checkbox => function ($value) {
                return json_decode($value, true);
            },
            default => $value,
        };

        return $variable instanceof \Closure
            ? call_user_func($variable, $value)
            : $variable;
    }

    /**
     * Определяет следующий порядковый номер сортировки
     * 
     * @param  int|null  $form_id
     * @return int
     */
    public static function nextSortingPosition($form_id)
    {
        return (int) static::whereCompanyFormId($form_id)->max('sorting') + 1;
    }
}
