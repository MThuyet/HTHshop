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
		Schema::create('products', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('product_category_id')->nullable();
			$table->string('name')->unique();
			$table->string('slug')->unique();
			$table->enum('type', ['CREW_NECK', 'PLACKET_COLLAR']);
			$table->string('description')->nullable();
			$table->boolean('active')->default(1);
			$table->timestamps();
			$table->softDeletes();

			// Foreign keys
			$table->foreign('product_category_id')->references('id')->on('product_category')->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('products');
	}
};
