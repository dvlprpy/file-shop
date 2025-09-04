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
        Schema::create('pivot_user_package', function (Blueprint $table) 
        {
           $table->unsignedBigInteger('user_id');
           $table->unsignedBigInteger('package_id');
           $table->integer('amount');
           $table->timestamps(); 

           $table->primary(['user_id', 'package_id']); // primary key ترکیبی
           $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
           $table->foreign('package_id')->references('package_id')->on('packages')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // جدول pivot که به users و packages وابسته است
        Schema::dropIfExists('pivot_user_package');
    }
};
