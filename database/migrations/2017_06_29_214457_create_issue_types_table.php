<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssueTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('issues', function (Blueprint $table) {
            $table->integer('issue_type_id')->unsigned();

            $table->foreign('issue_type_id')->references('id')->on('issue_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('issues', function($table) {
            $table->dropForeign('issues_issue_type_id_foreign');
            $table->dropColumn('issue_type_id');
        });

        Schema::table('issue_types', function($table) {
            $table->dropForeign('issue_types_user_id_foreign');
            $table->dropIfExists('issue_types');
        });
    }
}
