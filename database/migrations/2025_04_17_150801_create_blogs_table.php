<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->foreignId('blog_category_id')->constrained('blog_categories')->onDelete('cascade');
            $table->string('image');
            $table->string('image_alt');
            $table->string('index_image')->nullable();
            $table->string('index_image_alt')->nullable();
            $table->boolean('showed')->default(0);
            $table->boolean('show_at_home')->default(0);
            $table->string('title');
            $table->text('introduction');
            $table->text('content_table');
            $table->text('first_paragraph');
            $table->text('description');
            $table->string('author_name');
            $table->string('author_title');
            $table->string('author_image');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
