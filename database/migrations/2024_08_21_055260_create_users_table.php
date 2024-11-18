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
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');  // Foreign key to clients table
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');  // Foreign key to companies table
            $table->foreignId('group_id')->constrained('groups')->onDelete('cascade');  // Foreign key to groups table
            $table->foreignId('role_id')->constrained('role')->onDelete('cascade'); 
            $table->string('usertype')->nullable();
            $table->string('name', 250)->nullable();
            $table->string('username')->unique();;
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->double('sizeMax')->nullable()->default(2);
            $table->double('sizeUse')->nullable()->default(1);
            $table->string('phone', 20)->nullable();
            $table->string('avatar')->nullable();
            $table->string('sex', 10)->nullable();
            $table->string('ip_address')->nullable();
            $table->tinyInteger('is_facedata')->default(0)->nullable();
            $table->tinyInteger('is_support_face')->default(0)->nullable();
            $table->tinyInteger('status')->default(1)->nullable();
            $table->tinyInteger('lastLogin')->nullable();
            $table->integer('last_seen')->nullable();
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        
    }
};
