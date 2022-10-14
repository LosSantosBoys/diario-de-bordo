<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

require_once __DIR__ . '/../../app/helpers.php';

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'slug' => clean($this->faker->sentence()),
            'titulo' => $this->faker->sentence(),
            'conteudo' => $this->faker->text(),
            'visivel' => $this->faker->boolean(),
            'dataDePublicacao' => $this->faker->dateTimeBetween('now', '+14 days'),
        ];
    }
}
