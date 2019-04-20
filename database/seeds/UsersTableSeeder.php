<?php

use App\Http\Services\Avatars;
use App\User;
use App\Role;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class, 50)->create();
        $avatars = new Avatars();
        $clientRole = Role::where('name', 'client')->first();

        foreach ($users as $user) {
            $user->roles()->sync([$clientRole->id]);

            $avatars->createRandomAvatar($user);
        }
    }
}
