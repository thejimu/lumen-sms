<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateInboxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inbox', function (Blueprint $table) {
            $table->timestamp('UpdatedInDB')->default(DB::raw('LOCALTIMESTAMP(0)'));
            $table->timestamp('ReceivingDateTime')->default(DB::raw('LOCALTIMESTAMP(0)'));
            $table->text('Text');
            $table->string('SenderNumber')->default('');
            $table->string('Coding')->default('Default_No_Compression');
            $table->text('UDH');
            $table->string('SMSCNumber')->default('');
            $table->integer('Class')->default('-1');
            $table->text('TextDecoded')->default('');
            $table->id('ID');
            $table->text('RecipientID');
            $table->boolean('Processed')->default('false');
            $table->integer('Status')->default('-1');

        });

        DB::table('inbox')->raw("CHECK ('Coding' IN
                              ('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression'))");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inbox');
    }
}
