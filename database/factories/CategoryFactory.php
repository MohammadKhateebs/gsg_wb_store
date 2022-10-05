<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name=$this->faker->words(3,true);
        return [
            'parent_id'=>null,
            'name'=>$name,
            'slug'=>Str::slug($name),
            'description'=>$this->faker->text(),
            'image'=>$this->faker->imageUrl(),
        ];
    }
}
