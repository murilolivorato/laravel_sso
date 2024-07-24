<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAdminManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_admin_managers', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('user_admins')->onDelete('cascade');

            $table->integer('area_id')->unsigned()->index();
            $table->foreign('area_id')->references('id')->on('user_admin_access_areas')->onDelete('cascade');

            // $table->unique(['user_id','area_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_admin_managers', function(Blueprint $table){
            $table->dropForeign('user_admin_managers_user_id_foreign');
            $table->dropForeign('user_admin_managers_area_id_foreign');
        });
        Schema::dropIfExists('user_admin_managers');
    }
}