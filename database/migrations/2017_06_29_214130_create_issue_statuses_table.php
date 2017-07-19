<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssueStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('issues', function (Blueprint $table) {
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('issue_statuses')->onDelete('cascade');
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
            $table->dropForeign('issues_status_id_foreign');
            $table->dropColumn('status_id');
        });

         Schema::table('issue_statuses', function($table) {
            $table->dropForeign('issue_statuses_user_id_foreign');
            $table->dropIfExists('issue_statuses');
        });
    }
}
