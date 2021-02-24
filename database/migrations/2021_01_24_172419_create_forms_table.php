<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id');
            $table->foreignId('teams_id');
            $table->foreignId('competitors_id');
            $table->foreignId('processed_by')->nullable();
            //form
            //$table->string('comp_type')->nullable();
            $table->string('title')->nullable();
            $table->string('vnev')->nullable();
            $table->string('knev')->nullable();
            $table->date('birth')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('sex')->nullable();
            $table->string('mother')->nullable();
            $table->integer('zip')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('team_reg_code')->nullable();
            $table->string('federal_reg_code')->nullable();
            $table->boolean('privacy_policy')->nullable();
            //sportorvosi
            $table->date('sport_time')->nullable();
            $table->boolean('can_race')->nullable();
            $table->date('sport_valid')->nullable();
            //process
            $table->year('year');
            $table->string('status'); // saved - pending - accepted
            $table->string('payment')->nullable(); //none = null - pending - done
            //$table->foreignId('payment_id')->nullable();
            $table->string('deny')->nullable();
            //timestamps
            $table->timestamp('turn_in')->nullable();
            $table->timestamp('processed')->nullable();
            $table->date('form_valid')->nullable();
            //files
            $table->string('profile_photo')->nullable();
            $table->string('data_sheet')->nullable();
            $table->string('sport_sheet')->nullable();
            $table->string('license')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forms');
    }
}
