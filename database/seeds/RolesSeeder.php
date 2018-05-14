<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name'        => 'Administrator',
                'slug'        => 'admin',
                'description' => 'Administrator',
                'level'       => 100,
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate([
                'slug'        => $role['slug'],
            ], [
	            'name'        => $role['name'],
	            'description' => $role['description'],
	            'level'       => $role['level'],
            ]);
        }
    }
}
