<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

class BasicPersmissionSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:permissions {table} {url} {icon} {menu_label}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed basic permission CRUD for table';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info("starting seeding permissions for {$this->argument('table')}");
        $permissions = [
            ['name' => "create {$this->argument('table')}", 'description' => "Can create {$this->argument('table')}", "url" => null, "label" => null, "sidebar_menu" => 0, "guard_name" => "sanctum"],
            ['name' => "update {$this->argument('table')}", 'description' => "Can create {$this->argument('table')}", "url" => null, "label" => null, "sidebar_menu" => 0, "guard_name" => "sanctum"],
            ['name' => "show {$this->argument('table')}", 'description' => "Can create {$this->argument('table')}", 'url' => "{$this->argument('url')}", 'label' => "{$this->argument('menu_label')}", 'sidebar_menu' => 1, "guard_name" => "sanctum"],
            ['name' => "delete {$this->argument('table')}", 'description' => "Can create {$this->argument('table')}", "url" => null, "label" => null, "sidebar_menu" => 0, "guard_name" => "sanctum"]
        ];
        Permission::insert($permissions);
        $this->info("complete seeding permissions for {$this->argument('table')}");
    }
}
