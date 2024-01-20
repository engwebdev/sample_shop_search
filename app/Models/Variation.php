<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'variations';

    protected $fillable = [
        'id',
        'variation_title_id',
        'variation_title_name',
        'variation_value_id',
        'variation_value_name',
        'variation_price',
    ];

    public function variationTitles(): BelongsTo
    {
        return $this->belongsTo(
            VariationTitles::class,
            'variation_title_id',
            'id'
        );
    }

    public function variationValues(): BelongsTo
    {
        return $this->belongsTo(
            VariationValues::class,
            'variation_value_id',
            'id'
        );
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'products_variations',
            'variation_id',
            'product_id',
            'id',
            'id'
        );
    }
}
