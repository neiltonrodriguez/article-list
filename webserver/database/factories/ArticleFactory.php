<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;

class ArticleFactory extends Factory
{
    protected $model = Article::class;
    /**
     * Define the model's default state.
     *
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(4, true),
            'description' => $this->faker->paragraph(),
            'text' => $this->faker->paragraphs(5, true),
            'image' => $this->faker->imageUrl(750, 480, 'tecnologie', true, 'inteligência artificial', true, 'jpg'),
            'created_at' => now()
        ];
    }
}
