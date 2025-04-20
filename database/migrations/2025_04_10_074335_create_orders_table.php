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
			$table->string('order_code', 10)->unique();
			$table->string('email');
			$table->string('fullname');
			$table->string('location');
			$table->string('phone', 11);
			$table->string('note')->nullable();
			$table->enum('status', ['PENDING', 'CONFIRMED', 'SHIPPING', 'DONE', 'CANCELLED'])->default('PENDING');
			$table->string('cancel_reason')->nullable();
			$table->decimal('total_price', 12, 2);
			$table->timestamps();
			$table->softDeletes();
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
