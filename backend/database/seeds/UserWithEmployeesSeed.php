<?php

use Illuminate\Database\Seeder;

class UserWithEmployeesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\User::class, 10)->create()->each(function (\App\Models\User $user) {
            $user->employees()
                ->saveMany(
                    factory(\App\Models\Employee::class, rand(1, 20))
                        ->make()
                );
        });

        \App\Models\User::first()->update(['email' => 'teste@teste.com']);
    }
}
