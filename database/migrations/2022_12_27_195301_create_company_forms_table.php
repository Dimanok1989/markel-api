<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable();
            $table->string('name')->comment('Наименование формы');
            $table->string('description')->nullable()->comment('Описание формы');
            $table->boolean('is_active')->default(false)->comment('Флаг автивной формы');
            $table->boolean('is_public')->default(true)->comment('Анонимный доступ');
            $table->integer('sorting')->nullable()->comment('Порядковый номер сортировки');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('company_form_inputs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_form_id')->nullable();
            $table->string('name', 50)->comment('Наименование поля');
            $table->string('description')->nullable()->comment('Описание поля ввода');
            $table->integer('type')->comment('Тип поля ввода');
            $table->jsonb('attributes')->nullable()->comment('Дополнительные параметры поля ввода');
            $table->boolean('is_active')->default(false)->comment('Активное поле ввода');
            $table->boolean('is_public')->default(false)->comment('Может быть заполнено с публичной страницы');
            $table->integer('sorting')->nullable()->comment('Порядковый номер сортировки столбцов');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_form_inputs');
        Schema::dropIfExists('company_forms');
    }
};
