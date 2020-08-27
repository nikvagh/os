<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id');
            $table->string('number_type',200);
            $table->string('number_subtype',200);
            $table->string('number',100);
            $table->string('upgrade_type',100);
            $table->double('starting_bid_amount',8 ,2);
            $table->foreignId('duration');
            $table->foreignId('fee');
            $table->string('coupon',100);
            $table->string('accept_payment_type',100);
            $table->dateTime('bid_end_datetime', 0);
            $table->enum('notification', ['on', 'off']);
            $table->foreignId('purchaser');
            $table->enum('status', ['Enable', 'Disable']);
            $table->enum('live', ['Y', 'N']);
            // $table->timestamps();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bids');
    }
}
