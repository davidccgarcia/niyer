<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('shopping_cart_id');
            $table->string('address');
            $table->string('city');
            $table->string('receiver_name');
            $table->string('email');
            $table->enum('status', ['created', 'received'])->default('created');
            $table->uuid('guide_number');
            $table->decimal('total');

            $table->foreign('shopping_cart_id')->references('id')->on('shopping_carts');
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
        Schema::dropIfExists('orders');
    }
}
