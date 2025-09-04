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
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('package_id');
            $table->string('package_title');
            $table->text('package_description');
            $table->decimal('package_price', 10, 2);
            $table->uuid('package_uuid')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // ابتدا جدول‌های pivot یا child که به packages وابسته‌اند
        Schema::dropIfExists('pivot_user_package');
        Schema::dropIfExists('package_file');

        // سپس جدول parent
        Schema::dropIfExists('packages');
    }
};
