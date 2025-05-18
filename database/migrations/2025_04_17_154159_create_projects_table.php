<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->date('date_of_build');
            $table->longText('address');
            $table->longText('address_location')->nullable();
            $table->longText('virtual_location')->nullable();
            $table->string('scheme_name');
            $table->integer('floors_count');
            $table->longText('details');
            $table->string('img');
            $table->string('cover_img')->nullable();
            $table->text('images')->nullable();
            $table->string('logo')->nullable(); // Added logo column
            $table->boolean('show_home')->default(false); // Added show_home column
            $table->enum('status', ['available', 'under_construction', 'ready', 'sold'])
                  ->default('available');
            $table->integer('status_percent');
            $table->foreignId('project_category_id')->constrained('project_categories')->onDelete('cascade');
            $table->integer('sort_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
