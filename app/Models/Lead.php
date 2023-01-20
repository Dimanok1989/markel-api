<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'company_form_id',
        'user_id',
        'status_id',
        'ip_address',
        'user_agent',
    ];

    /**
     * Ключи данных заявки
     * 
     * @return array
     */
    public function getInputKeysAttribute()
    {
        return $this->form->inputs->map(fn ($input) => $input->input_key)->toArray();
    }

    /**
     * Данные в заявке
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function data()
    {
        return $this->hasMany(LeadData::class);
    }

    /**
     * Форма ввода данных
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function form()
    {
        return $this->belongsTo(CompanyForm::class, 'company_form_id');
    }
}
