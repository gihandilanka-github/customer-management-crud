<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission ;
use App\User;

class InsertUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Dilanka',
            'email' => 'youremailaddress@gmail.com',
            'password' => bcrypt('abc123'),
            'remember_token' => \Illuminate\Support\Str::random(10),
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);

        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'admin_permission']);

        $role->givePermissionTo($permission);
        $user->assignRole($role);
    }
}
