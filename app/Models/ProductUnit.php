<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductUnit extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'tenant_id',
        'product_id',
        'unit_id',
        'barcode',
        'purchase_price',
        'selling_price',
        'conversion',
        'is_base',
        'is_default_purchase',
        'is_default_sale',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_base' => 'boolean',
        'is_default_purchase' => 'boolean',
        'is_default_sale' => 'boolean',
        'is_active' => 'boolean'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
