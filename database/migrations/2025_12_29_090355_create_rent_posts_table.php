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
        Schema::create('rent_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('title', 200);
            $table->text('description')->nullable();
            $table->bigInteger('price');
            $table->decimal('deposit', 12, 2)->nullable();
            $table->float('area')->nullable();
            $table->string('address')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->boolean('furnished')->default(false);

            $table->string('contact_phone', 15)->nullable();
            $table->string('status', 20)->default('còn thuê');
            $table->integer('views')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_posts');
    }
};