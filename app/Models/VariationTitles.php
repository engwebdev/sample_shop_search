<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class VariationTitles extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'variation_titles';

    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    public function variationValues(): HasMany
    {
        return $this->hasMany(
            VariationValues::class,
            'variation_title_id',
            'id'
        );
    }

    public function variations(): HasMany
    {
        return $this->hasMany(
            Variation::class,
            'variation_title_id',
            'id'
        );
    }
}
