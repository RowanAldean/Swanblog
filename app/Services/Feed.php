<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;
use Intervention\Image\Facades\Image;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use App\Models\Post;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class Feed
{
    private $bearerToken;

    private $client;

    private $headers;

    public function __construct($token)
    {
        $this->bearerToken = $token;
        $this->headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
        ];
        $this->client = new Client(['base_uri' => 'https://api.twitter.com']);
    }

    // Get a recent tweet from someones twitter
    public function fetchRecentTweetAsPost($username)
    {
        $response = $this->client->get('/2/users/by/username/' . $username . '?' . 'user.fields=profile_image_url,description', ['headers' => $this->headers]);

        $jsonResponse = json_decode($response->getBody()->read(1024));

        $twitterID = $jsonResponse->{'data'}->{'id'};
        $profilePicURL = $jsonResponse->{'data'}->{'profile_image_url'};

        $recentTweets = $this->client->get('/2/users/' . $twitterID . '/tweets?' . 'exclude=replies,retweets&media.fields=url', ['headers' => $this->headers]);

        $tweetDumpJson = json_decode($recentTweets->getBody());
        $recentTweet = $tweetDumpJson->{'data'}[0]->{'text'};

        $user = User::firstOrCreate([
            'is_bot' => true,
            'name' => $jsonResponse->{'data'}->{'name'},
            'username' => $username,
            'email' => 'faketweet@null.com',
            'password' => $username,
        ]);

        $profilePicURL = str_replace('normal', '400x400', $profilePicURL);

        $profile = Profile::firstOrCreate([
            'user_id' => $user->id,
            'bio' =>  'This is a bot account that mirrors Twitter (here is the bio):' . $jsonResponse->{'data'}->{'description'},
            'website' => 'https://twitter.com/' . $username,
            'image' => $profilePicURL,
        ]);

        $profile->save();

        $user->posts()->firstOrCreate([
            'caption' => $recentTweet,
        ]);
    }
}
