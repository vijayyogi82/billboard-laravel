<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillboardFacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billboard_faces', function (Blueprint $table) {
            $table->id();
			$table->string('barcode')->unique();
			$table->bigInteger('billboard')->default(0)->unsigned();
			$table->bigInteger('type')->default(0)->unsigned();
			$table->bigInteger('category')->default(0)->unsigned();
			$table->bigInteger('sub_category')->default(0)->unsigned();
			$table->string('lanloard_name')->nullable();
			$table->string('lanloard_type')->nullable();
			$table->date('lease_start')->nullable();
			$table->date('lease_end')->nullable();
			$table->boolean('lease_renewal')->default(false);
			$table->boolean('landlord_registration')->default(false);
			$table->string('max_road_speed')->nullable();
			$table->string('distance_from_road')->nullable();
			$table->string('bord_to_road_angle')->nullable();
			$table->string('strret_to_bord_hight')->nullable();
			$table->string('traffic_count')->nullable();
			$table->string('foot_count')->nullable();
			$table->tinyInteger('lsm')->nullable()->comment('1 => Low Income, 2 => Medium Income, 3 => High Income');
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('billboard_faces');
    }
}
