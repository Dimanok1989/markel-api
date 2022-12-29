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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->foreignId('company_form_id');
            $table->foreignId('user_id')->nullable()->comment('Пользователь, создавший заявку');
            $table->integer('status_id')->nullable()->comment('Идентификатор статуса заявки');
            $table->ipAddress()->nullable()->comment('IP-адрес клиента, оставившего заявку');
            $table->string('user_agent', 500)->nullable()->comment('Пользовательское приложение клиента');
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
        Schema::dropIfExists('leads');
    }
};
