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
        Schema::create('purchase_entrys', function (Blueprint $table) {
            $table->id();
            $table->integer('par_sup_id');
            $table->date('purchase_date', 50);
            $table->string('purchase_no', 50);
            $table->string('purchase_type', 50);
            $table->text('remark');
            $table->double('net_amount');
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
