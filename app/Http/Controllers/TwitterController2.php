<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;

class TwitterController2 extends Controller
{

    private $connection;
    private $id_user;
    public function __construct()
    {
        if (Auth::check()) {
            $this->id_user = Auth::user()->id;

            $account = Account::where("user_id", $this->id_user)
            ->where('platform', 'twitter')->first();
        } else {
            // Handle the case where no user is authenticated
            $this->id_user = null; // or any default value
        }
        dd(Auth::check());
        $this->connection = new TwitterOAuth(
            $account['consumer_key'],
            $account['consumer_secret'],
            $account['access_token'],
            $account['refresh_token']
        );
    }

    public function postTweet(Request $request)
    {

        $tweet = $request->input('tweet');
        $hasFile = $request->hasFile('media');
        
        $file = $request->file('media');
        $filepath = $file->getRealPath();

        $connection = $this->connection;
        $connection->setApiVersion(1.1);
        $media = $connection->upload('media/upload', ['media' => $filepath]);
        $connection->setTimeouts(10, 15);
        $connection->setApiVersion(2);
        $parameters = [
            'text' => $tweet,
            'media' => ['media_ids' => [$media->media_id_string]]
        ];

        $result = $connection->post('tweets', $parameters, true);
        
        dd($result);
    }

    public function deleteTweet($id)
    {
    
        $connection = $this->connection;

        // Delete the tweet
        $result = $connection->delete("tweets/$id");

    if (!$connection->getLastHttpCode() === 200) {
        return "Error: " . $result->errors[0]->title;
        }
    
        dd($result);
    }
}