<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->binary('name');
            $table->binary('email', 100);
            $table->string('password');
            $table->binary('phone');
            $table->binary('contact_person')->nullable();
            $table->binary('alternate_email')->nullable();
            $table->binary('alternate_phone')->nullable();
            $table->unsignedInteger('role_id');
            $table->string('role_name');
            $table->string('photo')->nullable();            
            $table->binary('name_of_company')->nullable();
            $table->binary('register_name')->nullable();
            $table->binary('vat_gst_number')->nullable();
            $table->binary('building_number')->nullable();
            $table->binary('building_name')->nullable();
            $table->binary('street_address')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->unsignedInteger('state_id')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->string('postal_code')->nullable();
            $table->binary('po_box')->nullable();
            $table->binary('alt_city')->nullable();
            $table->binary('alt_state')->nullable();
            $table->binary('alt_country')->nullable();
            $table->binary('alt_postal_code')->nullable();
            $table->string('country_code')->nullable();
            $table->string('city_code')->nullable();
            $table->binary('teliphone_number')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_at')->nullable();
            $table->boolean('activated')->default(true);
            $table->bigInteger('added_by')->default(0)->unsigned();
            $table->dateTime('added_at');
            $table->bigInteger('updated_by')->default(0)->unsigned();
            $table->dateTime('updated_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
