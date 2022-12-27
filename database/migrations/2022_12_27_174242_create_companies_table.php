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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->comment('Владелец компании');
            $table->string('name', 50)->comment('Наименование компании');
            $table->string('slug')->comment('Сокращенное наименование');
            $table->string('description')->nullable()->comment('Описание');
            $table->boolean('is_active')->default(false)->comment('Флаг активной компании');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('company_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->foreignId('user_id');
            $table->integer('role_id')->nullable()->comment('Роль пользователя в компании');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_user');
        Schema::dropIfExists('companies');
    }
};
