<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

/**
 * Class UserSeeder
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'firstname'  => 'Maxim',
                'lastname'   => 'Tkachenko',
                'email'      => 'maxim.tkachenko@sigma.software',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'password'   => bcrypt('123456')
            ],
        ];

	    $adminRole = Role::where('slug', Role::ADMINISTRATOR_SLUG)->first();

        foreach ($users as $user) {
            $result = User::create($user);

            $result->attachRole($adminRole);
        }
    }

}
