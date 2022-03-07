<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Profile;
use App\Models\Post;

class UsersDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // First let's make sure to seed my 'default' account.
        $u1 = new User;
        $u1->name = "Rowan";
        $u1->username = "rowan-is-testing";
        $u1->email = "rowan-cant-test@example.com";
        $u1->password = "helloworld";
        $u1->save();

        $pr1 = new Profile;
        $pr1->user_id = User::first()->id;
        $pr1->bio = "Hi my name is Rowan and I developed this web app!";
        $pr1->website = "https://www.aldeansoftware.com";
        $pr1->save();

        /* Create 10 users (and a profile for each)
          - each user has 5 posts and each post has 3 comments.
          We could use multiple seeder files for this but the extra overhead
          is unnecessary when we can simply use 'Magic Methods'.
        */
        User::factory()
            ->hasProfile() // These are called 'Magic Methods' and are inferred relationships that we can use to seed with.
            ->has(
                Post::factory()
                    ->hasComments(3)
                    ->count(5)
            )
            ->count(10)
            ->create();
        /*We are left with 11 users & profiles,
        50 posts (10*5) and 150 comments (50*3). */
    }
}
