<?php

use App\Models\Backend\Filter;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CategoryTableSeeder extends Seeder
{
    private $categories = [
        'Системные блоки' => [
            'Производитель' => ['Acer','Alienware','Apple','ASUS','Dell','Lenovo','MSI'],
            'Игровой компьютер' => ['да','нет'],
            'Семейство процессоров' => [
                'Intel Core i3',
                'Intel Core i5',
                'Intel Core i7',
                'Intel Core i9',
                'AMD Ryzen 3',
                'AMD Ryzen 5',
                'AMD Ryzen 7'
            ],
            'Операционная система' => [
                'Linux','Windows 10 Pro','Windows 10 Домашняя','без ОС'
            ]
        ],
        'Ноутбуки' => [
            'Производитель' => ['Acer','Alienware','Apple','ASUS','Dell','Lenovo','MSI'],
            'Игровой ноутбук' => ['да','нет'],
            'Линейка процессора' => ['Core i3','Core i5','Core i7','Core i9']
        ],
        'Моноблоки' => [
            'Производитель' => ['Acer','Apple','ASUS','Dell','HP','Lenovo','MSI'],
            'Сенсорный экран' => ['есть','нет']
        ],
        'Телевизоры' => [
            'Производитель' => ['Samsung','Sony','LG','DEXP'],
            'Поддержка Smart TV' => ['есть','нет'],
            'Разрешение экрана' => [
                '8K UltraHD, 7680×4320',
                '4K UltraHD, 3840×2160',
                'FullHD, 1920х1080',
                'HD, 1366x768'
            ],
            'Тип подсветки экрана' => ['Direct LED','Edge LED','OLED']
        ],
        'Смартфоны' => [
            'Производитель' => [
                'Apple','ASUS','DEXP','HONOR',
                'HTC','Huawei','Nokia','Motorola','Nokia','Philips','Samsung','Sony','Xiaomi'
            ],
            'Объем оперативной памяти' => [
                '512 МБ','1 ГБ','1 ГБ','2 ГБ','3 ГБ','4 ГБ','6 ГБ','8 ГБ','12 ГБ'
            ],
            'Операционная система' => [
                'Android', 'iOS'
            ],
            'Количество ядер' => [
                '2','4','6','8'
            ]
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        foreach ($this->categories as $category => $filters) {
            $model = new \App\Models\Backend\Category();
            $model->title = $category;
            $model->public = 1;
            $model->save();
            $model->url()->create(['url' => $model->slug]);
            $model->image()->create([
                'position' => 0,
                'small' => $faker->imageUrl($width = 150, $height = 150),
                'medium' => $faker->imageUrl($width = 300, $height = 300),
                'large' => $faker->imageUrl($width = 800, $height = 800),
            ]);

            foreach ($filters as $group => $filter) {
                $filterGroup = new \App\Models\Backend\FilterGroup();
                $filterGroup->title = $group;
                $filterGroup->category_id = $model->id;
                $filterGroup->position = 0;
                $filterGroup->save();
                foreach ($filter as $f) {
                    Filter::create([
                        'filter_group_id' => $filterGroup->id,
                        'title' => $f,
                        'position' => 0
                    ]);
                }
            }
        }
    }
}
