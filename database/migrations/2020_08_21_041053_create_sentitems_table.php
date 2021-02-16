<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSentitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sentitems', function (Blueprint $table) {
            $table->timestamp('UpdatedInDB')->default(DB::raw('LOCALTIMESTAMP(0)'));
            $table->timestamp('InsertIntoDB')->default(DB::raw('LOCALTIMESTAMP(0)'));
            $table->timestamp('SendingDateTime')->default(DB::raw('LOCALTIMESTAMP(0)'));
            $table->timestamp('DeliveryDateTime')->nullable()->default(null);
            $table->text('Text');
            $table->string('DestinationNumber',20)->default('');
            $table->string('Coding',255)->default('Default_No_Compression');
            $table->text('UDH');
            $table->string('SMSCNumber',20)->default('');
            $table->integer('Class')->default(-1);
            $table->text('TextDecoded')->default('');
            $table->id('ID');
            $table->string('SenderID',255);
            $table->integer('SequencePosition')->default('1');
            $table->string('Status',255)->default('SendingOK');
            $table->integer('StatusError')->default(-1);
            $table->integer('TPMR')->default(-1);
            $table->integer('RelativeValidity')->default(-1);
            $table->text('CreatorID');
            $table->integer('StatusCode')->default(-1);


            DB::raw('PRIMARY KEY ("ID", "SequencePosition")');

            DB::raw("CHECK ('Coding' IN('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression'))");
            DB::raw("CHECK ('Status' IN ('SendingOK','SendingOKNoReport','SendingError','DeliveryOK','DeliveryFailed','DeliveryPending','DeliveryUnknown','Error','Reserved'))");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sentitems');
    }
}
