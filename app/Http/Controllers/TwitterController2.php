<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Account;
use App\Models\Media;
use App\Models\Post;

class TwitterController2 extends Controller
{

    private $connection;
    public function __construct()
    {
        $this->connection = new TwitterOAuth(
            env('TWITTER_API_KEY'),
            env('TWITTER_API_SECRET'),
            env('TWITTER_CONSUMER_KEY'),
            env('TWITTER_CONSUMER_SECRET')
        );
    }

    public function postTweet(Request $request)
{
    DB::beginTransaction();

    try {
        $newTweet = new Post();
        $newTweet->user_id = Auth::user()->id;
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

        if ($result && $result->data->id) {
            $newTweet->post_id = $result->data->id;
            $newTweet->status = 'OK';
            $newTweet->content = $parameters['text'];

            if ($hasFile) {
                $newTweet->media_url = $request->file('media')->store('media', 'public');
            }
            
            $newTweet->save();
        }

        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        throw $e;
    }

    return redirect()->route('user.view-post');
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
        return redirect()->route('user.view-post');
    }

    public function viewAllTweet()
    {
        $post = DB::table('posts')->where('user_id', Auth::user()->id)->get();
        return view('user.post.view')->with('data', $post);
    }
}