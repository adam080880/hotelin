<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Field extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function(Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('books', function(Blueprint $table) {
            $table->foreign('room_id')->references('id')->on('rooms')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('transactions', function(Blueprint $table) {
            $table->foreign('book_id')->references('id')->on('books')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('room_images', function(Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rooms', function(Blueprint $table) {
            $table->dropForeign(['type_id']);
        });
        Schema::table('books', function(Blueprint $table) {
            $table->dropForeign(['room_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::table('transactions', function(Blueprint $table) {
            $table->dropForeign(['book_id']);
            $table->dropForeign(['admin_id']);
        });
        Schema::table('room_images', function(Blueprint $table) {
            $table->dropForeign(['type_id']);
        });
    }
}
