<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_type', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->string('name');
            $table->string(column: 'flag')->unique(); // Unique keyword for flag
            $table->string(column: 'related_table');
            $table->integer('level');
            $table->boolean('voice_authentication')->default(1);
            $table->boolean('face_authentication')->default(1);
            $table->timestamps(); // created_at and updated_at fields
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_type');
    }
}
