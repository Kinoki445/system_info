<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('documents_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignId('document_id')->constrained('documents')->cascadeOnDelete();
            $table->integer('quantity'); // Количество товара
            $table->integer('inventory_quantity')->nullable(); // Остаток по инвентаризации
            $table->integer('inventory_error')->nullable(); // Ошибка инвентаризации
            $table->timestamps(); // Дата создания и обновления
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents_products');
    }
};
