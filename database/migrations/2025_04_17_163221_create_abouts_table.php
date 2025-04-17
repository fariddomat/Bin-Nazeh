<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('discription');
            $table->string('img')->nullable();
            $table->string('icon')->nullable();
            $table->string('class')->nullable();
            $table->integer('sort_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};