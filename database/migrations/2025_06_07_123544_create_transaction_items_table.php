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
        Schema::create('transaction_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('transaction_id')->constrained()->onDelete('cascade');

            // Ubah jadi nullable dan set null saat obat dihapus
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')
                  ->references('id')
                  ->on('obats')
                  ->onDelete('set null');

            $table->integer('quantity');
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_items');
    }
};
