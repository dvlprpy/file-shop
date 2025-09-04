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
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('file_id');
            $table->string('file_title', 250);
            $table->string('file_original_name', 250);
            $table->text('file_description');
            $table->string('file_type');
            $table->decimal('file_size', 10, 2);
            $table->string('file_hash', 250);
            $table->string('path');
            $table->enum('visibility', ['public', 'private'])->default('private');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // ابتدا جدول‌های pivot یا child که به files وابسته‌اند
        Schema::dropIfExists('package_file');

        // سپس جدول files
        Schema::dropIfExists('files');
    }
};
