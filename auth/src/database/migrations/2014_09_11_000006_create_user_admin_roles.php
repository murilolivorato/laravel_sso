<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAdminRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('user_admin_roles', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            // $table->string('title', 40)->unique();
            $table->string('title', 40);
            // $table->string('label', 300)->unique();
            $table->string('label', 300);

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
        Schema::defaultStringLength(191);
        Schema::dropIfExists('user_admin_roles');
    }
}
