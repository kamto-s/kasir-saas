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
        Schema::create('product_units', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignUlid('product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignUlid('unit_id')->constrained('units')->cascadeOnDelete();

            $table->string('barcode', 50)->nullable();

            // harga beli terakhir untuk satuan tersebut (akan diperbarui saat Purchase).
            $table->unsignedBigInteger('purchase_price')->default(0);
            // harga jual aktif untuk satuan tersebut.
            $table->unsignedBigInteger('selling_price')->default(0);

            $table->decimal('conversion', 10, 2)->default(1);

            $table->boolean('is_base')->default(false);
            $table->boolean('is_default_purchase')->default(false);
            $table->boolean('is_default_sale')->default(false);

            $table->boolean('is_active')->default(true);

            $table->unsignedTinyInteger('sort_order')->default(1);

            $table->timestamps();

            $table->index('product_id');
            $table->index('unit_id');
            $table->index('barcode');
            $table->unique('tenant_id', 'barcode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_units');
    }
};
