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
        Schema::create('lead_executor', function (Blueprint $table) {
            $table->comment('Исполнители в заявке');
            $table->foreignId('user_id')->comment('Идентификатор пользователя');
            $table->foreignId('lead_id')->comment('Идентификатор заявки');
            $table->timestamps();

            $table->unique(['user_id', 'lead_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead_executor');
    }
};
