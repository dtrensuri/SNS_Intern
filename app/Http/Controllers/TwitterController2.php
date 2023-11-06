<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterController2 extends Controller
{
    // public function connectToTwitter(Request $request)
    // {
    //     $consumer_key = env('TWITTER_API_KEY');
    //     $consumer_secret = env('TWITTER_API_SECRET');

    //     $callback = 'http://localhost:8000/connecttotwitter/cb';

    //     // Set up TwitterOAuth
    //     $connection = new TwitterOAuth($consumer_key, $consumer_secret);

    //     $access_token = $connection->oauth('oauth/request_token', ['oauth_callback'=>$callback]);

    //     $route = $connection->url('oauth/authorize', ['oauth_token'=>$access_token['oauth_token']]);

    //     return redirect($route);
    // }

    // public function cbToTwitter(Request $request)
    // {
    //     $response = $request->all();

    //     $consumer_key = env('TWITTER_API_KEY');
    //     $consumer_secret = env('TWITTER_API_SECRET');

    //     $oauth_token = $response['oauth_token'];
    //     $oauth_verifirer = $response['oauth_verifier'];

    //     $connection = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_verifirer);

    //     $token = $connection->oauth('oauth/access_token', ['oauth_verifier'=>$oauth_verifirer]);

    //     $oauth_token = $token['oauth_token'];
    //     $oauth_token_secret = $token['oauth_token_secret'];

    //     return $this->postTweet($oauth_token, $oauth_token_secret);
    // }

    public function postTweet(Request $request)
    {
        $consumer_key = env('TWITTER_API_KEY');
        $consumer_secret = env('TWITTER_API_SECRET');
        $oauth_token = env('TWITTER_ACCESS_TOKEN');
        $oauth_token_secret = env('TWITTER_ACCESS_TOKEN_SECRET');

        $tweet = $request->input('tweet');
        $hasFile = $request->hasFile('media');
        
        $file = $request->file('media');
        $filepath = $file->getRealPath();

        $connection = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
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
}
