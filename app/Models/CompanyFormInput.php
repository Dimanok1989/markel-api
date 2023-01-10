<?php

namespace App\Models;

use App\Services\Enums\CompanyFormInputs;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
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
        'type' => CompanyFormInputs::class,
        'attributes' => AsArrayObject::class,
        'is_active' => 'boolean',
        'is_public' => 'boolean',
    ];

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
