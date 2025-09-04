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
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('payment_id');
            $table->foreignId('payment_user_id')->references('user_id')->on('users')->onDelete('cascade')->index();
            $table->enum('payment_method', ['wallet', 'card'])->default('card');
            $table->decimal('payment_amount', 10, 2);
            $table->string('payment_bank_name', 250);
            $table->string('payment_res_num')->index();
            $table->string('payment_ref_num')->index();
            $table->timestamp('payment_created_at')->useCurrent()->index();
            $table->timestamp('payment_updated_at')->useCurrent()->useCurrentOnUpdate()->index();
            $table->enum('payment_status', ['complete', 'incomplete'])->default('incomplete')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
