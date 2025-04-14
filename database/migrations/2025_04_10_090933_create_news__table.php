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
			$table->string('title')->unique();
			$table->string('slug')->unique();
			$table->string('excerpt')->nullable();
			$table->longText('content');
			$table->string('thumbnail')->nullable();
			$table->boolean('active')->default(1);
			$table->timestamps();
			$table->softDeletes();

			$table->unsignedBigInteger('news_category_id');
			$table->unsignedBigInteger('user_id_created')->nullable();
			$table->unsignedBigInteger('user_id_updated')->nullable();

			$table->foreign('news_category_id')->references('id')->on('news_categories')->onDelete('cascade');
			$table->foreign('user_id_created')->references('id')->on('users')->onDelete('set null');
			$table->foreign('user_id_updated')->references('id')->on('users')->onDelete('set null');
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
