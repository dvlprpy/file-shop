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
            $table->bigIncrements('user_id');            
            $table->string('fullname', 100); 
            $table->string('username', 50)->unique(); 
            $table->string('password', 255); /* رمز عبور - ذخیره هش (مثلاً bcrypt -> 60 کاراکتر) */
            $table->string('phone', 11)->unique();
            $table->string('email', 255)->unique();
            $table->decimal('wallet', 10, 2)->default(0);/* کیف پول - عدد اعشاری تا 10 رقم با 2 رقم اعشار */
            $table->enum('role', ['normaluser', 'seller', 'adminsystem'])
                ->default('normaluser');
            $table->text('profile_picture')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });


        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // ----------------- Child tables -----------------
        Schema::dropIfExists('payments');
        Schema::dropIfExists('pivot_user_package');
        Schema::dropIfExists('package_file');

        // ----------------- Parent tables ----------------
        Schema::dropIfExists('packages');
        Schema::dropIfExists('plans');
        Schema::dropIfExists('files');
        Schema::dropIfExists('users');

        // ----------------- Auxiliary tables ------------
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
