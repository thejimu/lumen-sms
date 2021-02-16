<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->text('ID');
            $table->timestamp('UpdatedInDB')->default(DB::raw('LOCALTIMESTAMP(0)'));
            $table->timestamp('InsertIntoDB')->default(DB::raw('LOCALTIMESTAMP(0)'));
            $table->timestamp('TimeOut')->default(DB::raw('LOCALTIMESTAMP(0)'));
            $table->boolean('Send')->default('no');
            $table->boolean('Receive')->default('no');
            $table->string('IMEI',35)->primary();
            $table->string('IMSI',35);
            $table->string('NetCode',10)->default('ERROR');
            $table->string('NetName')->default('ERROR');
            $table->text('Client');
            $table->integer('Battery')->default(-1);
            $table->integer('Signal')->default(-1);
            $table->integer('Sent')->default(0);
            $table->integer('Received')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phones');
    }
}
