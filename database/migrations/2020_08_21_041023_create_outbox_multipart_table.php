<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateOutboxMultipartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outbox_multipart', function (Blueprint $table) {
            $table->text('Text');
            $table->string('Coding',255)->default('Default_No_Compression');
            $table->text('UDH');
            $table->integer('Class')->default('-1');
            $table->text('TextDecoded')->nullable()->default(null);
            $table->id('ID');
            $table->integer('SequencePosition')->default('1');
            $table->string('Status')->default('Reserved');
            $table->integer('StatusCode')->default('-1');

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
        Schema::dropIfExists('outbox_multipart');
    }
}
