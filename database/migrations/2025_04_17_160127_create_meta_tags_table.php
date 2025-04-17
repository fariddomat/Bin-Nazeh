<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meta_tags', function (Blueprint $table) {
            $table->id();
            $table->string('page_route')->unique();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('canonical_link')->nullable();
            $table->text('schema_markup')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meta_tags');
    }
};