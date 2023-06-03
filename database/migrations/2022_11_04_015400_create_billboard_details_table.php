<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillboardDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billboard_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('billboard')->default(0);
            $table->string('owner_ref')->nullable();
            $table->string('height')->nullable();
            $table->string('width')->nullable();
            $table->string('size')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('provience')->nullable();
            $table->string('city')->nullable();
            $table->string('suburb')->nullable();
            $table->string('rate_card')->nullable();
            $table->string('orintation_id')->nullable();
            $table->string('orintation')->nullable();
            $table->string('type')->nullable();
            $table->string('type_id')->nullable();
            $table->string('lanlord_expiry')->nullable();
            $table->string('available_start_date')->nullable();
            $table->string('distance_from_road')->nullable();
            $table->string('readable_distance')->nullable();
            $table->string('traffic_volume')->nullable();
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
        Schema::dropIfExists('billboard_details');
    }
}
