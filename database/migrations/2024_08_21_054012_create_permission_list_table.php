<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_list', function (Blueprint $table) {
            $table->id(); // Auto-increment ID (Primary key)
            $table->string('name', 250)->nullable(); // Name column with a maximum length of 250, nullable
            $table->string('permission_group_name', 250)->nullable(); // Permission group name, nullable
            $table->tinyInteger('permission_group_flag')->nullable()->index(); // Permission group flag, indexed
            $table->string('permission_route', 250)->nullable(); // Permission route, nullable
            $table->tinyInteger('permission_keyword')->nullable()->index(); // Permission keyword, indexed
            $table->integer('sort_order')->nullable(); // Sort order, nullable
            $table->integer('status')->default(1); // Status with default value of 1
            $table->timestamp('created_at')->nullable(); // Timestamp for created_at
            $table->timestamp('updated_at')->nullable(); // Timestamp for updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_list');
    }
}
