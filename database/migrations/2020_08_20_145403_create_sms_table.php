<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * CREATE TABLE sms
    (
    sms_id serial NOT NULL,
    date_insert timestamp with time zone NOT NULL DEFAULT now(),
    date_send timestamp with time zone,
    "number" character varying(16) NOT NULL,
    message character varying(1600) NOT NULL,
    date_error timestamp with time zone,
    date_cancel timestamp with time zone,
    CONSTRAINT sms_pkey PRIMARY KEY (sms_id)
    )
     * @return void
     */
    public function up()
    {
        Schema::create('sms', function (Blueprint $table) {
            $table->id('sms_id');
            $table->timestampTz('date_insert')->default(\Illuminate\Support\Facades\DB::Raw('now()'));
            $table->timestamp('date_send')->nullable();
            $table->string('number', '16');
            $table->string('message', '1600');
            $table->timestampTz('date_error')->nullable();
            $table->timestampTz('date_cancel')->nullable();
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
        Schema::dropIfExists('sms');
    }
}
