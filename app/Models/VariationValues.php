<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class VariationValues extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'variation_values';

    protected $fillable = [
        'id',
        'variation_title_id',
        'name',
        'description',
    ];

    public function variationTitle(): BelongsTo
    {
        return $this->belongsTo(
            VariationTitles::class,
            'variation_title_id',
            'id',
        );
    }

    public function variations(): HasMany
    {
        return $this->hasMany(
            Variation::class,
            'variation_value_id',
            'id'
        );
    }

}
