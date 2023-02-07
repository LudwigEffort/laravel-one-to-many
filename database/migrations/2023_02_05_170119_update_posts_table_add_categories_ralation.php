<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsTableAddCategoriesRalation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {

            // crere la colonna della chiave esterna
            $table->unsignedBigInteger('category_id')->after('id')->nullable();

            // creare la relazione delle tabelle
            $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {

            // eliminare la relazione
            $table->dropForeign(['category_id']);

            // eliminare la colonna
            $table->dropColumn('category_id');

        });
    }
}
