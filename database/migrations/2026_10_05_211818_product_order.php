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
         Schema::create('product_order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete(); 
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->date('thedayoftheprocess');
            $table->integer('quantity')->default(1);
            $table->index(['product_id']); 
            $table->index(['order_id']); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('product_order');
    }
};