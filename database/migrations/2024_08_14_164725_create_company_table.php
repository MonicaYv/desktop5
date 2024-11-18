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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade'); // Foreign key to 'clients' table
            $table->string('name', 30);         // Name column with a max of 30 characters
            $table->string('email')->unique();  // Email column (must be unique)
            $table->string('logo')->nullable(); // Logo column to store image path
            $table->string('contact', 15);      // Contact number with max 15 digits
            $table->timestamps();               // created_at and updated_at
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};
