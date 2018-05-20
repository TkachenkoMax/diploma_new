<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->tinyInteger('is_public');
            $table->tinyInteger('is_editable');
            $table->integer('creator_id', false, true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('creator_id')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calendars', function (Blueprint $table) {
            $table->dropForeign(['creator_id']);
        });

        Schema::dropIfExists('calendars');
    }
}
