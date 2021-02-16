<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateOutboxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outbox', function (Blueprint $table) {
            $table->timestamp('UpdatedInDB')->default(DB::raw('LOCALTIMESTAMP(0)'));
            $table->timestamp('InsertIntoDB')->default(DB::raw('LOCALTIMESTAMP(0)'));
            $table->timestamp('SendingDateTime')->default(DB::raw('LOCALTIMESTAMP(0)'));
            $table->time('SendBefore')->default('23:59:59');
            $table->time('SendAfter')->default('00:00:00');
            $table->text('Text');
            $table->string('DestinationNumber', 20)->default('');
            $table->string('Coding', 255)->default('Default_No_Compression');
            $table->text('UDH');
            $table->integer('Class')->default('-1');
            $table->text('TextDecoded')->default('');
            $table->id('ID');
            $table->boolean('MultiPart')->default('false');
            $table->integer('RelativeValidity')->default('-1');
            $table->string('SenderID', 255);
            $table->timestamp('SendingTimeOut')->default(DB::Raw('LOCALTIMESTAMP(0)'));
            $table->string('DeliveryReport',10)->default('default');
            $table->text('CreatorID');
            $table->integer('Retries')->default(0);
            $table->integer('Priority')->default(0);
            $table->string('Status',255)->default('Reserved');
            $table->integer('StatusCode')->default('-1');

            $table->index(['SendingDateTime','SendingTimeOut'], 'outbox_date');
            $table->index('SenderID', 'outbox_sender');

            DB::raw("CHECK ('Coding' IN
                               ('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression'))");
            DB::raw("CHECK ('DeliveryReport' IN ('default','yes','no'))");
            DB::raw("CHECK ('Status' IN
                               ('SendingOK','SendingOKNoReport','SendingError','DeliveryOK','DeliveryFailed','DeliveryPending',
                                'DeliveryUnknown','Error','Reserved'))");

        });

        DB::raw('CREATE TRIGGER update_timestamp BEFORE UPDATE ON outbox FOR EACH ROW EXECUTE PROCEDURE update_timestamp()');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outbox');
    }
}
