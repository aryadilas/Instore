<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('recipient');
            $table->string('receipt')->nullable();
            $table->string('city');
            $table->string('province');
            $table->string('address');
            $table->string('postal');
            $table->string('expedition');
            $table->integer('shipping_price');
            $table->integer('total');
            $table->enum('status', ['success', 'paymentReview', 'rejected', 'process', 'shipping', 'finished']);
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
        Schema::dropIfExists('transactions');
    }
}
