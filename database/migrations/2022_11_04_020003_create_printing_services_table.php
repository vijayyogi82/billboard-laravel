<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintingServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printing_services', function (Blueprint $table) {
            $table->id();
            $table->string('barcode')->unique();
            $table->bigInteger('billboard');
            $table->bigInteger('billboard_face');
            $table->string('service_provider')->nullable();
            $table->double('price')->nullable()->comment('Sq. Meter');
            $table->string('substrate')->nullable();
            $table->boolean('independent')->default(false);
            $table->bigInteger('added_by')->default(0)->unsigned();
            $table->dateTime('added_at');
            $table->bigInteger('updated_by')->default(0)->unsigned();
            $table->dateTime('updated_at')->nullable();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printing_services');
    }
}
