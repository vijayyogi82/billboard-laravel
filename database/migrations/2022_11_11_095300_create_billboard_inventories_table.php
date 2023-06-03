<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillboardInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billboard_inventories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('billboard');
            $table->bigInteger('month');
            $table->bigInteger('year');
            $table->bigInteger('d1');
            $table->bigInteger('d2');
            $table->bigInteger('d3');
            $table->bigInteger('d4');
            $table->bigInteger('d5');
            $table->bigInteger('d6');
            $table->bigInteger('d7');
            $table->bigInteger('d8');
            $table->bigInteger('d9');
            $table->bigInteger('d10');
            $table->bigInteger('d11');
            $table->bigInteger('d12');
            $table->bigInteger('d13');
            $table->bigInteger('d14');
            $table->bigInteger('d15');
            $table->bigInteger('d16');
            $table->bigInteger('d17');
            $table->bigInteger('d18');
            $table->bigInteger('d19');
            $table->bigInteger('d20');
            $table->bigInteger('d21');
            $table->bigInteger('d22');
            $table->bigInteger('d23');
            $table->bigInteger('d24');
            $table->bigInteger('d25');
            $table->bigInteger('d26');
            $table->bigInteger('d27');
            $table->bigInteger('d28');
            $table->bigInteger('d29');
            $table->bigInteger('d30');
            $table->bigInteger('d31');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billboard_inventories');
    }
}
