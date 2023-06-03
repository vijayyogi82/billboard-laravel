<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('barcode')->unique();
            $table->string('campaign_name');
            $table->string('advertiser')->nullable();
            $table->string('category')->nullable();
            $table->string('street_address')->nullable();
            $table->bigInteger('country_id')->default(0);
            $table->string('country_name')->nullable();
            $table->bigInteger('state_id')->default(0);
            $table->string('state_name')->nullable();
            $table->bigInteger('provience_id')->default(0);
            $table->string('provience_name')->nullable();
            $table->bigInteger('city_id')->default(0);
            $table->string('city_name')->nullable();
            $table->bigInteger('suburb_id')->default(0);
            $table->string('suburb_name')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('campaigns');
    }
}
