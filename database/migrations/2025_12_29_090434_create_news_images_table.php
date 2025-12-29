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
        Schema::create('news_images', function (Blueprint $table) {
            $table->id('image_id');

            $table->unsignedBigInteger('news_id'); // ref: news.news_id
            $table->string('url', 2048);
            $table->boolean('is_cover')->default(false);
            $table->integer('sort_order')->default(0);

            $table->dateTime('created_at')->useCurrent();

            $table->foreign('news_id')
                ->references('id')
                ->on('news')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_images');
    }
};
