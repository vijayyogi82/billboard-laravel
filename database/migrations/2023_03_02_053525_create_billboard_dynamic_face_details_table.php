<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillboardDynamicFaceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billboard_dynamic_face_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('billboard')->default(0)->unsigned();
			$table->bigInteger('billboard_face')->default(0)->unsigned();
			$table->double('size')->default(0)->comment('In Squre Meter');
			$table->double('height')->default(0)->comment('In Meter');
			$table->double('width')->default(0)->comment('In Meter');
			$table->double('pixel_height')->default(0);
			$table->double('pixel_width')->default(0);
			$table->string('uptime')->nullable();
			$table->bigInteger('slots_amount')->default(0);
			$table->double('slot_duration')->default(0);
			$table->double('per_slot_price')->default(0);
			$table->bigInteger('min_slots')->default(0);
			$table->string('min_duration')->nullable();
			$table->double('rate_card')->default(0);
			$table->double('max_discount')->default(0)->comment('In Percentage');
			$table->boolean('contact_user')->default(false);
			$table->string('bit_rate')->nullable();
			$table->string('comression_format')->nullable();
			$table->string('max_file_size')->nullable();
			$table->bigInteger('digital_creative_submission')->default(0);
			$table->boolean('available_on_auction')->default(false);
			$table->double('auction_rate_card')->default(0);
			$table->double('auction_time')->default(0)->comment('In Hourse');
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
        Schema::dropIfExists('billboard_dynamic_face_details');
    }
}
