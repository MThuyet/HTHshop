<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('fullname', 50);
			$table->string('email')->unique();
			$table->string('phone', 11)->nullable();
			$table->string('password', 60);
			$table->string('provider_id')->nullable();
			$table->enum('provider', ['GOOGLE', 'FACEBOOK'])->nullable();
			$table->string('description')->nullable();
			$table->enum('role', ['CUSTOMER', 'ADMIN', 'STAFF'])->default('CUSTOMER');
			$table->boolean('active')->default(1);
			$table->timestamps();
			$table->softDeletes();
		});
	}
	public function down(): void
	{
		Schema::dropIfExists('users');
	}
};
