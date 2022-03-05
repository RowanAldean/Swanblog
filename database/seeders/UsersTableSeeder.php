<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Database\Factories\UserFactory;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u1 = new User;
        $u1->name = "Rowan";
        $u1->username = "rowan-doesnt-testing";
        $u1->email = "rowan-cant-test@example.com";
        $u1->password = "helloworld";
        $u1->save();

        User::factory()->count(10)->create();
    }
}
