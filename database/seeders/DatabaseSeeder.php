<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $postsCreate = Permission::create(['name' => 'post.create']);
        $postsUpdate = Permission::create(['name' => 'post.update']);

        $admin = Role::create([
            'name' => 'ADMIN'
        ]);

        $publishier = Role::create([
            'name' => 'PUBLICADOR'
        ]);

        $visitor = Role::create([
            'name' => 'VISITANTE'
        ]);

        //Asignning permissions to role
        $publishier->givePermissionTo($postsCreate);
        $publishier->givePermissionTo($postsUpdate);

        User::create([
            'name' => 'Jancker',
            'email' => 'sepulved.janck@gmail.com',
            'password' => Hash::make('12345678'),
        ])->assignRole(['ADMIN', 'PUBLICADOR']);
        //App\Models\User::assignRole
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
