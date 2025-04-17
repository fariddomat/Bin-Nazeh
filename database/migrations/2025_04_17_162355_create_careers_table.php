<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->integer('block_number')->nullable();
            $table->string('city');
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->enum('wish', ['استثمار', 'سكن', 'اخرى']);
            $table->string('other_wish')->nullable();
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};