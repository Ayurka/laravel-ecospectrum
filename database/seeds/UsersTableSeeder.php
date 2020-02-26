<?php

use Illuminate\Database\Seeder;
use App\Models\Backend\Admin;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Admin::class, 'admin', 1)->create();
    }
}
