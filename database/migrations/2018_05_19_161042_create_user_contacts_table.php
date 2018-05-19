<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_a_id', false, true);
            $table->integer('user_b_id', false, true);
            $table->tinyInteger('status');
            $table->timestamps();
            $table->foreign('user_a_id')
                ->references('id')->on('users');
            $table->foreign('user_b_id')
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
        Schema::table('user_contacts', function (Blueprint $table) {
            $table->dropForeign(['user_a_id', 'user_b_id']);
        });

        Schema::dropIfExists('user_contacts');
    }
}
