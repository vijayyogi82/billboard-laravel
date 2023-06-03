<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillboardStaticFaceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billboard_static_face_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('billboard')->default(0)->unsigned();
			$table->bigInteger('billboard_face')->default(0)->unsigned();
			$table->bigInteger('size')->default(0)->comment('In Squre Meter');
			$table->bigInteger('height')->default(0)->comment('In Meter');
			$table->bigInteger('width')->default(0)->comment('In Meter');
			$table->string('dimensions')->nullable()->comment('Based On Hight * Width');
			$table->string('substrate')->nullable();
			$table->string('add_on')->nullable();
			$table->boolean('available_on_auction')->default(false);
			$table->string('min_rent_durartion')->nullable();
			$table->double('rate_card')->default(0);
			$table->double('max_discount')->default(0)->comment('In Percentage');
			$table->double('reserve_price')->default(0)->comment('Max Reserve Price For Auction');
			$table->boolean('rope_access')->default(false);
			$table->boolean('printing_service')->default(false);
			$table->boolean('flighting_service')->default(false);
			$table->bigInteger('days_for_printing')->default(0);
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
        Schema::dropIfExists('billboard_static_face_details');
    }
}
