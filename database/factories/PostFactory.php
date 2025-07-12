<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        $fakerEn = \Faker\Factory::create('en_US');
        $fakerVi = \Faker\Factory::create('vi_VN');
        $titleEn = $fakerEn->name . ' from ' . $fakerEn->city;
        $titleVi = $fakerVi->name . ' từ ' . $fakerVi->city;
        $testimonialEn = $fakerEn->realText(120);
        $testimonialVi = $fakerVi->realText(120);
        $now = now();
        return [
            'title' => ['en' => $titleEn, 'vi' => $titleVi],
            'slug' => ['en' => Str::slug($titleEn), 'vi' => Str::slug($titleVi)],
            'short_description' => ['en' => $testimonialEn, 'vi' => $testimonialVi],
            'content' => ['en' => $fakerEn->realText(300), 'vi' => $fakerVi->realText(300)],
            'meta_title' => ['en' => $titleEn, 'vi' => $titleVi],
            'meta_description' => ['en' => $fakerEn->sentence, 'vi' => $fakerVi->sentence],
            'type' => 'review',
            'status' => 'published',
            'published_at' => $now,
            'is_featured' => $this->faker->boolean(30),
            'order_column' => null,
            'category_id' => null,
            'author_id' => null,
            'related_service_id' => null,
            'view_count' => $this->faker->numberBetween(0, 100),
            'seo_keywords' => json_encode(['en' => $fakerEn->word, 'vi' => $fakerVi->word]),
        ];
    }
} 