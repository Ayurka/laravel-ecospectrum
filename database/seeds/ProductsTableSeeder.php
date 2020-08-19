<?php

use Illuminate\Database\Seeder;

use App\Models\Backend\Category;
use App\Models\Backend\Product;
use App\Services\ImageService;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        $categoryIds = Category::where('public', 1)->pluck('id')->toArray();
        $filterIds = [];

        factory(Product::class, 100)->create()->each(function($product) use($categoryIds, $faker, $filterIds) {
            $categoryId = Arr::random($categoryIds);
            $product->category_id = $categoryId;
            $product->update();

            $product->image()->create([
                'position' => $product->id,
                'small' => $faker->imageUrl($width = 150, $height = 150),
                'medium' => $faker->imageUrl($width = 300, $height = 300),
                'large' => $faker->imageUrl($width = 800, $height = 800),
            ]);

            foreach($product->getCategory->getGroupsFilters as $groupFilter) {
                $ids = $groupFilter->filters()->pluck('id')->toArray();
                $filterRandom = Arr::random($ids);
                $filterIds[] = $filterRandom;
            }

            $product->getPivotFilters()->sync($filterIds);

            if ($product->getCategory) {
                $category_slug = $product->getCategory->url->url;
                $slug = $category_slug . '/' . $product->slug;
                return $product->url()->create(['url' => $slug]);
            }
            $product->url()->create(['url' => $product->slug]);
        });
    }
}
