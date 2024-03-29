<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
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
        $u1->name = "Rowan Aldean";
        $u1->username = "rowan-is-admin";
        $u1->email = "rowan@swansea.ac.uk";
        $u1->password = Hash::make("rowan123");
        $u1->admin = true;
        $u1->save();

        $pr1 = new Profile;
        $pr1->user_id = User::first()->id;
        $pr1->bio = "Hi my name is Rowan and I developed this web app!";
        $pr1->website = "https://www.aldeansoftware.com";
        $pr1->save();

        event(new Registered($u1));

        Auth::login($u1);

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
                    ->hasLikes(5)
            )
            ->count(10)
            ->create();
        /*We are left with 11 users & profiles,
        50 posts (10*5) and 150 comments (50*3). */
    }
}
