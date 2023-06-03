<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignBillboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_billboards', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('campaign')->default(0);
            $table->bigInteger('billboard')->default(0);
            $table->tinyInteger('status')->default(0)->comment("0 => InActive, 0 => Active");
            $table->tinyInteger('billboard_type')->default(1)->comment("1 => Static, 2 => Digital");
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
        Schema::dropIfExists('campaign_billboards');
    }
}
