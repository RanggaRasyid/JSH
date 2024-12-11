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
        Schema::table('masa_magang', function (Blueprint $table) {
            $table->date('startdate')->change();
            $table->date('enddate')->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('masa_magang', function (Blueprint $table) {
            $table->dropColumn('startdate');
            $table->dropColumn('enddate');
        });
    }
};
