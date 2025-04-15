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
			$table->decimal('price', 12, 2);
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
				'BOTH_SIDES',         // Cả 2 mặt trước sau
			]);
			$table->unsignedBigInteger('product_id');
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
