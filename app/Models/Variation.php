<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'variation_title_id',
        'variation_title_name',
        'variation_value_id',
        'variation_value_name',
        'variation_price',
    ];
}
