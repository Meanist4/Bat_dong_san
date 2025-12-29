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
        Schema::create('sale_post_chats', function (Blueprint $table) {
            $table->id('chat_id');

            $table->unsignedBigInteger('sale_id');     // ref: sale_posts.sale_id
            $table->unsignedBigInteger('sender_id');   // ref: users.user_id
            $table->unsignedBigInteger('receiver_id'); // ref: users.user_id

            $table->text('message');
            $table->string('attachment_url', 2048)->nullable();
            $table->boolean('is_read')->default(false);

            $table->dateTime('created_at')->useCurrent();

            $table->index('sale_id');
            $table->index('sender_id');
            $table->index('receiver_id');

            $table->foreign('sale_id')
                ->references('id')
                ->on('sale_posts')
                ->onDelete('cascade');

            $table->foreign('sender_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('receiver_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_post_chats');
    }
};
