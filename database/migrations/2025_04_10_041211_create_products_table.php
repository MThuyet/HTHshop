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
			$table->enum('type', ['ROUND_NECK', 'COLLAR_NECK']);
			$table->string('name', 100)->unique();
			$table->string('slug', 120)->unique();
			$table->text('description')->nullable();
			$table->decimal('default_price', 12, 2);
			$table->boolean('active')->default(1);
			$table->tinyInteger('discount')->default(0);
			$table->boolean('has_customization')->default(0);
			$table->integer('view')->default(0);
			$table->integer('favorite')->default(0);
			$table->integer('bought')->default(0);
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('set null');
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
