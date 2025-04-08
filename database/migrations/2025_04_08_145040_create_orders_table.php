<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('orders', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id');
			$table->char('order_code', 10)->unique();
			$table->string('note')->nullable();
			$table->enum('status', ['IN_CART', 'PENDING', 'CONFIRMED', 'SHIPPING', 'DONE', 'CANCELLED'])->default('IN_CART');
			$table->string('cancel_reason')->nullable();
			$table->string('location');
			$table->string('phone', 11);
			$table->float('total_price');
			$table->timestamps();
			$table->softDeletes();

			// foreign key
			$table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('orders');
	}
};
