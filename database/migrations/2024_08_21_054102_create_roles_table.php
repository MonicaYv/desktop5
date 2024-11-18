<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');  // Foreign key to clients table
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');  // Foreign key to companies table
            $table->string('name', 50);  // Role name
            $table->text('description')->nullable();  // Role description
            $table->json('permissions');  // Permissions stored as JSON array
            $table->timestamps();  // created_at and updated_at columns
        });
        
        
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
