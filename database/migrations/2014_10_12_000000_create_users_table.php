<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ap_pat');
            $table->string('ap_mat');
            $table->string('email')->unique();
            $table->string('dni');
            $table->string('sexo');
            $table->date('fecha_nac');
            $table->string('telefono');
            $table->unsignedBigInteger('ubigeo_id')->nullable();
            $table->foreign('ubigeo_id')->references('id')->on('ubigeo')->onDelete('set null');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
