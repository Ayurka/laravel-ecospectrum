<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Backend\Page;

class PageTableSeeder extends Seeder
{
    private $pages = [
        'service' => 'Услуги',
        'payment' => 'Оплата',
        'delivery' => 'Доставка',
        'about' => 'О компании'
    ];

    /**
     * Run the database seeds.
     *
     * @param Page $page
     * @param Faker $faker
     * @return void
     */
    public function run(Page $page, Faker $faker)
    {
        foreach ($this->pages as $key => $item) {
            $page->create([
                'title' => $item,
                'slug' => $key,
                'announcement' => $faker->text($maxNbChars = 200),
                'description' => $faker->realText($maxNbChars = 500, $indexSize = 2),
                'seo_title' => $item,
                'seo_keywords' => implode(', ', $faker->words($nb = 5, $asText = false)),
                'seo_description' => $faker->text($maxNbChars = 200),
                'category_id' => 0,
                'public' => 1,
            ]);
        }
    }
}
