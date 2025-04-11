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
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('fullname', 50);
			$table->string('username', 20)->unique();
			$table->string('email', 100)->unique();
			$table->string('phone', 11)->nullable();
			$table->string('password');
			$table->string('description')->nullable();
			$table->boolean('active')->default(1);
			$table->enum('role', ['ADMIN', 'STAFF']);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('users');
	}
};
