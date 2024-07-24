<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserUserAdminRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('user_user_admin_roles', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('user_admins')->onDelete('cascade');

            $table->integer('role_id')->unsigned()->index();
            $table->foreign('role_id')->references('id')->on('user_admin_roles')->onDelete('cascade');

            // $table->unique(['user_id','role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_user_admin_roles', function(Blueprint $table){
            $table->dropForeign('user_user_admin_roles_user_id_foreign');
            $table->dropForeign('user_user_admin_roles_role_id_foreign');
        });

        Schema::dropIfExists('user_user_admin_roles');
    }
}
