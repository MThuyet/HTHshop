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
		Schema::create('product_variants', function (Blueprint $table) {
			$table->id();
			$table->string('color_code', 7);
			$table->decimal('price', 10, 2);
			$table->enum('size', ['1', '2', '3', '4', '5', '6', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL']);
			$table->enum('print_position', [
				'LEFT_CHEST',         // Ngực trái
				'RIGHT_CHEST',        // Ngực phải
				'CENTER_CHEST',       // Giữa ngực
				'CENTER_CHEST_A4',    // Giữa ngực A4
				'CENTER_CHEST_A3',    // Giữa ngực A3
				'FRONT_RIGHT',        // Trước phải
				'FRONT_LEFT',         // Trước trái
				'LOWER_FRONT_RIGHT',  // Trước dưới phải
				'LOWER_FRONT_LEFT',   // Trước dưới trái
				'BACK_NECK_CENTER',   // Sau giữa cổ
				'CENTER_BACK_A4',     // Giữa lưng A4
				'CENTER_BACK_A3',     // Giữa lưng A3
			]);
			$table->string('image')->nullable();
			$table->unsignedBigInteger('product_id');
			$table->integer('view')->default(0);
			$table->integer('favorite')->default(0);
			$table->integer('bought')->default(0);
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('product_variants');
	}
};
