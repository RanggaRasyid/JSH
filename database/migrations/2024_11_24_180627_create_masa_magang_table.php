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
        Schema::create('masa_magang', function (Blueprint $table) {
            $table->uuid('id_masa_magang')->primary();
            $table->string('startdate');
            $table->string('enddate');
            $table->boolean('status')->default(true);
            $table->string('nim')->nullable();
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('masa_magang');
    }
};
