<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->string('type');
            $table->boolean('appendix')->default(0);
            $table->string('code');
            $table->integer('room_count')->nullable();
            $table->integer('area');
            $table->longText('about')->nullable();
            $table->integer('price')->nullable();
            $table->integer('price_bank')->nullable();
            $table->longText('details');
            $table->string('img')->nullable();
            $table->longText('virtual_location')->nullable();
            $table->longText('youtube')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
