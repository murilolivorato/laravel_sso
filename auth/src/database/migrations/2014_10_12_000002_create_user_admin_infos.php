<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAdminInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('user_admin_infos', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user_admins')->onDelete('cascade');

            $table->string('cpf');
            // $table->string('cpf')->unique();

            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_admin_infos', function(Blueprint $table){
            $table->dropForeign('user_admin_infos_user_id_foreign');
        });


        Schema::dropIfExists('user_admin_infos');
    }
}
