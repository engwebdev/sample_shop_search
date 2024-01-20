<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'id',
        'title',
        'description',
        'price',
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function variations(): BelongsToMany
    {
        return $this->belongsToMany(
            Variation::class,
            'products_variations',
            'product_id',
            'variation_id',
            'id',
            'id'
        );
    }
}
