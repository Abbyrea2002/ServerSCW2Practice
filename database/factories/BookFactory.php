<?php 

namespace Database\Factories; 

use Illuminate\Database\Eloquent\Factories\Factory; 

/** 
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book> 
 */ 
//factory used to generate fake data for database
class BookFactory extends Factory 
{ 
    /** 
     * Define the model's default state. 
     * 
     * @return array<string, mixed> 
     */ 

    public function definition(): array 
    { 
        return [ 
            'title' => fake()->catchPhrase, 
            'author' => fake()->name, 
            'description' => fake()->text, 
            'published_year' => fake()->numberBetween(1900, 2024)
            ]; 
    } 
}

