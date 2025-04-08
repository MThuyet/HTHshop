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
		Schema::create('news', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('news_category_id')->nullable();
			$table->unsignedBigInteger('user_id')->nullable();
			$table->string('title');
			$table->string('slug')->unique();
			$table->string('excerpt');
			$table->longText('content');
			$table->string('thumbnail')->nullable();
			$table->boolean('active')->default(1);
			$table->timestamps();
			$table->softDeletes();

			// foreign key
			$table->foreign('news_category_id')->references('id')->on('news_category')->onDelete('set null');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('news');
	}
};
