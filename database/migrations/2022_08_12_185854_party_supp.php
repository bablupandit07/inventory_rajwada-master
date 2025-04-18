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
        Schema::create('m_party_supp', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('mobile', 30);
            $table->string('email', 70);
            $table->text('address', 30);
            $table->string('breckfast', 30);
            $table->string('lunch', 30);
            $table->string('dinner', 30);
            $table->string('hightea', 30);
            $table->string('type', 30);
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
