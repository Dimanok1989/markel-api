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
        Schema::create('lead_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id');
            $table->foreignId('input_id')->constrained('company_form_inputs');
            $table->string('value', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead_data');
    }
};
