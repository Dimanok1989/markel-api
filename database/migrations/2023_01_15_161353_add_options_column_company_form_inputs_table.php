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
        Schema::table('company_form_inputs', function (Blueprint $table) {
            $table->jsonb('options')->nullable()->comment('Варианты выбора')->after('attributes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_form_inputs', function (Blueprint $table) {
            $table->dropColumn('options');
        });
    }
};
