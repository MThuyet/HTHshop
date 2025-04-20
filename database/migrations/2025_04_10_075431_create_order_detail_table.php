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
		Schema::create('order_details', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('order_id');
			$table->unsignedBigInteger('product_variant_id')->nullable();
			$table->string('color')->nullable();
			$table->string('size')->nullable();
			$table->integer('quantity');
			$table->string('custom_image')->nullable();
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
			$table->foreign('product_variant_id')->references('id')->on('product_variants')->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('order_details');
	}
};
