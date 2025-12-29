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
        Schema::create('sale_post_images', function (Blueprint $table) {
            $table->id('image_id');

            $table->unsignedBigInteger('sale_id'); // ref: sale_posts.sale_id
            $table->string('url', 2048);
            $table->boolean('is_cover')->default(false);
            $table->integer('sort_order')->default(0);

            $table->dateTime('created_at')->useCurrent(); // chỉ có created_at (không có updated_at)

            $table->foreign('sale_id')
                ->references('id')
                ->on('sale_posts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_post_images');
    }
};
