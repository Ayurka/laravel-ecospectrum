<?php

namespace App\Console\Commands;

use App\Models\Backend\Admin as SuperAdmin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class Admin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create admin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = SuperAdmin::find(1);
        if (!$user) {
            $admin = new SuperAdmin();
            $admin->name = 'admin';
            $admin->email = 'admin@admin.com';
            $admin->password = Hash::make('password');
            $admin->save();
        }

    }
}
