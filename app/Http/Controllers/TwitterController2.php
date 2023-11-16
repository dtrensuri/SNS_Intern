<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;
use App\Models\Post;

class TwitterController2 extends Controller
{

    private $connection;
    private $id_user;
    public function __construct()
    {
        $this->connection = new TwitterOAuth(
            'EaOlEJkloxXtcl0h8jw8j7REn',
            'AqkGA1oZIVWpwYY0WpEQHPG1KJKtpse3TawMu3YUQei5rFGcFZ',
            '1502465858844917762-dwdJMUacdJZzwzqd06ifzCkGmWZR1B',
            'cg5aoOgnoUfsjb3naeYRPkUF06H6TSzr8qeNfKHe9qp1U'
        );
    }

    public function postTweet(Request $request)
    {
        $newTweet = new Post();

        $newTweet->user_id = Auth::user()->id;
        // $newTweet->created_at = now();
        $newTweet->platform = 'twitter';

        $tweet = $request->input('tweet');
        $hasFile = $request->hasFile('media');
        $connection = $this->connection;
        
        if ($hasFile) {
            $file = $request->file('media');
            $filepath = $file->getRealPath();

            $connection->setApiVersion(1.1);
            $media = $connection->upload('media/upload', ['media' => $filepath]);

            $parameters = [
                'text' => $tweet,
                'media' => ['media_ids' => [$media->media_id_string]]
            ];
        } else {
            $parameters = [
                'text' => $tweet
            ];
        }
        
        $connection->setApiVersion(2);
        $connection->setTimeouts(10, 15);
        $result = $connection->post('tweets', $parameters, true);
        if ($result->data->id) {
            $id_post = $result->data->id;
            $text = $result->data->text;
            $newTweet->post_id = $id_post;
            $newTweet->status = 'OK';
            $newTweet->content = $text;

            $newTweet->save();
        }
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
    $tweet = Post::where('post_id', $id);
    $tweet->delete();
        dd($result);
    }
}