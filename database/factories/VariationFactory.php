<?php

namespace Database\Factories;

use App\Models\Variation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Variation>
 */
class VariationFactory extends Factory
{
    protected $model = Variation::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $variation_titles = \App\Models\VariationTitles::all()->toArray();
        $variation_values = \App\Models\VariationValues::all()->toArray();
        $i = rand(0, 19);
        $j = rand(0, 19);

        return [
            'variation_title_id' => $variation_titles[$i]['id'],
            'variation_title_name' => $variation_titles[$i]['name'],
            'variation_value_id' => $variation_values[$j]['id'],
            'variation_value_name' => $variation_values[$j]['name'],

            'variation_price' => fake()->numberBetween($min = 500, $max = 8000)
        ];
    }
}
