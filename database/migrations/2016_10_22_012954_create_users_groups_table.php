<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table->increments('id');
        //foreign key for users
        $table->integer('user_id')->unsigned();
        $table->foreign('user_id')->references('id')->on('users');

        //foreign key for groups
        $table->integer('group_id')->unsigned();
        $table->foreign('group_id')->references('id')->on('groups');
        //will change to one when an user (id) creates a group
        $table->boolean('is_owner')->default(0);

        $table->timestamps();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_groups');
    }
}
