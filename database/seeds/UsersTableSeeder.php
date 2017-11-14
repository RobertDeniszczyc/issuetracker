<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 50)->create();

        $userArray = [
                            [
                                'id' => 51,
                                'name' => 'Rob Testuser',
                                'email' => 'rob@example.org',
                                'password' => Hash::make('password'),
                                'created_at' => date("Y-m-d H:i:s"),
                                'updated_at' => date("Y-m-d H:i:s")
                            ]
                        ];

        foreach ($userArray as $user) {
            $this->storeUser($user);
        }
    }

    private function storeUser($user)
    {
         DB::table('users')->insert([
            $user
        ]);
    }
}
