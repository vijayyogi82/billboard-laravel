<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillboardFaceAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billboard_face_addresses', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('billboard')->default(0)->unsigned();
			$table->bigInteger('billboard_face')->default(0)->unsigned();
			$table->string('area')->nullable();
			$table->bigInteger('city')->default(0)->unsigned();
			$table->bigInteger('state')->default(0)->unsigned();
			$table->bigInteger('province')->default(0)->unsigned();
			$table->bigInteger('country')->default(0)->unsigned();
			$table->string('suburb')->nullable();
			$table->string('lattitude')->nullable();
			$table->string('longitude')->nullable();
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
        Schema::dropIfExists('billboard_face_addresses');
    }
}
