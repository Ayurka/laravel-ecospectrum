<?php

use Illuminate\Database\Seeder;

use App\Models\Backend\Product;
use App\Services\ImageService;
use Faker\Generator as Faker;
use App\Models\Backend\Image;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param ImageService $image
     * @param Faker $faker
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 10)->create();
    }
}
