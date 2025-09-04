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
        Schema::create('categoriables', function(Blueprint $table) {
           $table->unsignedBigInteger('category_id');
           $table->unsignedBigInteger('categoriable_id');
           $table->string('categoriable_type',100)->collation('utf8_persian_ci');

           $table->primary(['category_id', 'categoriable_id', 'categoriable_type']);
           $table->index(['categoriable_id', 'categoriable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoriables');
    }
};
