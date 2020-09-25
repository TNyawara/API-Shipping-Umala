<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('consignment');
            $table->string('origin');
            $table->string('destination');
            $table->string('weight');
            $table->string('price');
            $table->string('user_id');
            $table->string('price_per_km');
            $table->string('travel_distance');
            $table->string('status')->nullable();
            $table->string('payment')->nullable();
            $table->date('expected_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
