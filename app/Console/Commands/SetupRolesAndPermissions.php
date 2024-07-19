<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Role;
use App\Models\Permission;

class SetupRolesAndPermissions extends Command
{
    protected $signature = 'roles:setup';
    protected $description = 'Set up roles and permissions';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Fetch the admin role and assign all permissions
        $adminRole = Role::where('name', 'admin')->first();
        $allPermissions = Permission::all()->pluck('id');
        $adminRole->permissions()->sync($allPermissions);

        // Fetch the blogger role and assign only blog-related permissions
        $blogerRole = Role::where('name', 'bloger')->first();
        $blogerPermissions = Permission::whereIn('name', [
            'Blogs Listing', 'Blogs Add', 'Blogs Edit', 'Blogs Delete'
        ])->pluck('id');
        $blogerRole->permissions()->sync($blogerPermissions);

        $this->info('Roles and permissions set up successfully.');
    }
}
