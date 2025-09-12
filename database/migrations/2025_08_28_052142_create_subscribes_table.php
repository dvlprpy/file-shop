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
        Schema::create('subscribes', function (Blueprint $table) {
            $table->bigIncrements('subscribe_id');
            $table->unsignedBigInteger('subscribe_user_id')->index();
            $table->unsignedBigInteger('subscribe_plan_id')->index();
            $table->integer('subscribe_download_limit');
            $table->integer('subscribe_download_count');
            $table->integer('subscribe_id_payment_amount');
            $table->timestamp('subscribe_created_at')->useCurrent();
            $table->timestamp('subscribe_expired_at')->useCurrent();

            $table->foreign('subscribe_user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('subscribe_plan_id')->references('plan_id')->on('plans')->onDelete('cascade');
            $table->primary('subscribe_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribes');
    }
};
