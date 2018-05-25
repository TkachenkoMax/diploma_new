<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', false, true);
            $table->integer('calendar_id', false, true);

            $table->foreign('user_id')
                ->references('id')->on('users');

            $table->foreign('calendar_id')
                ->references('id')->on('calendars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calendar_user', function (Blueprint $table) {
            $table->dropForeign('calendar_user_calendar_id_foreign');
            $table->dropForeign('calendar_user_user_id_foreign');
        });

        Schema::dropIfExists('calendar_user');
    }
}
