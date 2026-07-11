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
        Schema::table('product_units', function (Blueprint $table) {
            // 1. drop FK dulu, karena index 'barcode' (yang sebenarnya nempel di tenant_id) dipakai FK ini
            $table->dropForeign(['tenant_id']);

            // 2. baru bisa drop unique index yang salah
            $table->dropUnique('barcode');

            // 3. buat ulang FK ke tenants, sama persis seperti aslinya
            $table->foreign('tenant_id')->references('id')->on('tenants')->cascadeOnDelete();

            // 4. buat unique constraint yang benar: gabungan tenant_id + barcode
            $table->unique(['tenant_id', 'barcode'], 'product_units_tenant_barcode_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_units', function (Blueprint $table) {
            $table->dropUnique('product_units_tenant_barcode_unique');
            $table->dropForeign(['tenant_id']);
            $table->unique('tenant_id', 'barcode');
            $table->foreign('tenant_id')->references('id')->on('tenants')->cascadeOnDelete();
        });
    }
};
