<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMoviesTableAddLikeDislikeFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movies', function (Blueprint $table) {
            // $table->integer('like_id')->unsigned()->nullable();
            // $table->integer('dislike_id')->unsigned()->nullable();
            $table->integer('likes')->default(0);
            $table->integer('dislikes')->default(0);


            // $table->foreign('like_id')
            //     ->references('id')
            //     ->on('likes')
            //     ->onDelete('set null');

            // $table->foreign('dislike_id')
            // ->references('id')
            // ->on('dislikes')
            // ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movies', function (Blueprint $table) {
            // $table->dropForeign(['like_id']);
            // $table->dropForeign(['dislike_id']);
            // $table->dropColumn('like_id');
            // $table->dropColumn('dislike_id');
            $table->dropColumn('likes');
            $table->dropColumn('dislikes');

        });
    }
}
