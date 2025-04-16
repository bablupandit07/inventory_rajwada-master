<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empoyees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained('departments')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('designation_id')->constrained('designations')->onUpdate('cascade')->onDelete('cascade');
            $table->string('first_name', 150);
            $table->string('last_name', 150);
            $table->string('username', 50);
            $table->string('mobile_no', 50);
            $table->string('email', 50);
            $table->string('password', 50);
            $table->string('imgname', 255);
            $table->ipAddress('ipaddress');
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
        //
    }
};
