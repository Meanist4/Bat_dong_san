<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feedback_images', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('feedback_id');
            $table->string('url', 2048);
            $table->integer('sort_order')->default(0);

            $table->timestamps();

            $table->foreign('feedback_id')
                ->references('id')
                ->on('feedbacks')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedback_images');
    }
};
