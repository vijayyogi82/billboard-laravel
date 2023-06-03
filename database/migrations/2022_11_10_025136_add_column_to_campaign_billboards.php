<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToCampaignBillboards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaign_billboards', function (Blueprint $table) {
            $table->date('end_date')->nullable();
            $table->date('start_date')->nullable();
            $table->bigInteger('no_package')->default(0);
            $table->bigInteger('slot_duration')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaign_billboards', function (Blueprint $table) {
            $table->dropColumn('end_date');
            $table->dropColumn('start_date');
            $table->dropColumn('no_package');
            $table->dropColumn('slot_duration');
        });
    }
}
