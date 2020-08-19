<?php

use Illuminate\Database\Seeder;
use App\Models\Backend\FilterGroup;
use App\Models\Backend\Filter;

class FiltersTableSeeder extends Seeder
{
    private $filters = [
        'Производитель' => [
            'Acer',
            'Alienware',
            'Apple',
            'ASUS',
            'Dell',
            'HP',
            'Lenovo',
            'MSI'
        ],
        'Игровой ноутбук' => ['да','нет'],
        'Линейка процессора' => ['Core i3','Core i5','Core i7','Core i8']
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->filters as $key => $item) {
            $group = new FilterGroup();
            $group->title = $key;
            $group->save();
            foreach ($item as $k => $i) {
                Filter::create([
                    'filter_group_id' => $group->id,
                    'title' => $i,
                    'position' => $k
                ]);
            }
        }
    }
}
