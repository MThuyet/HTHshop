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
		Schema::create('order_detail', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('order_id');
			$table->unsignedBigInteger('product_id');
			$table->integer('quantity');
			$table->enum('color', ['BLACK', 'GRAY', 'WHITE']);
			$table->enum('size', ['1', '2', '3', '4', '5', '6', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL']);
			$table->timestamps();
			$table->softDeletes();

			// foreign key
			$table->foreign('order_id')->references('id')->on('orders');
			$table->foreign('product_id')->references('id')->on('products');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('order_detail');
	}
};
