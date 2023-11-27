<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Google_Client;
use Google_Service_YouTube;
use Google_Service_YouTube_Video;
use Google_Service_YouTube_VideoSnippet;
use Google_Service_YouTube_VideoStatus;

class YoutubeController extends Controller
{
    public function connectYoutube(Request $request)
    {
        $client = new Google_Client();
        $client->setApplicationName('My Project 116002');
        $client->setScopes([
            'https://www.googleapis.com/auth/youtube.upload'
        ]);
        $client->setAuthConfig('C:\Users\VT\Desktop\SNS_Intern\client_secret_395300426177-c6fcep8i3tpvt8jjqqhioq1j5noci9kg.apps.googleusercontent.com.json');
        $client->setAccessType('offline');

        $client->setRedirectUri('http://localhost:8000/public/callback');
        $authUrl = $client->createAuthUrl();
        return redirect($authUrl);
    }

    public function callbackYoutube(Request $request)
    {
        $client = new Google_Client();
        $client->setApplicationName('My Project 116002');
        $client->setScopes([
            'https://www.googleapis.com/auth/youtube.upload'
        ]);
        $client->setAuthConfig('C:\Users\VT\Desktop\SNS_Intern\client_secret_395300426177-c6fcep8i3tpvt8jjqqhioq1j5noci9kg.apps.googleusercontent.com.json');
        $client->setAccessType('offline');
        $client->setRedirectUri('http://localhost:8000/public/callback');

        $authCode = $request->input('code');
        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
        $account = new Account();
        $account->user_id = Auth::user()->id;
        $account->platform = 'youtube';
        $account->access_token = $accessToken['access_token'];
        $account->refresh_token = $accessToken['refresh_token'];
        $account->save();
        return view('index');

    }

    public function insertVideo(Request $request)
    {
        $client = new Google_Client();
        $client->setApplicationName('My Project 116002');
        $client->setScopes([
            'https://www.googleapis.com/auth/youtube.upload'
        ]);
        $client->setAuthConfig('C:\Users\VT\Desktop\SNS_Intern\client_secret_395300426177-c6fcep8i3tpvt8jjqqhioq1j5noci9kg.apps.googleusercontent.com.json');
        $client->setAccessType('offline');
        $client->setRedirectUri('http://localhost:8000/public/callback');
        $id_user = Auth::user()->id;
        $account = Account::where('user_id', $id_user)->where('platform', 'youtube')->first();
        $accessToken = [
            'access_token' => $account['access_token'],
            'refresh_token' => $account['refresh_token']
        ];
        $client->setAccessToken($accessToken);

        $service = new Google_Service_YouTube($client);

        $video = new Google_Service_YouTube_Video();

        $videoSnippet = new Google_Service_YouTube_VideoSnippet();
        $videoSnippet->setTitle('Test video');
        $videoSnippet->setDescription('Some content of video upload');
        $video->setSnippet($videoSnippet);

        $videoStatus = new Google_Service_YouTube_VideoStatus();
        $videoStatus->setPrivacyStatus('private');
        $video->setStatus($videoStatus);

        // if has file get path to file
        $hasFile = $request->hasFile('video');
        if ($hasFile) {
            $media = $request->file('video');
            $mediapath = $media->getRealPath();
        }

        // Insert the video
        $response = $service->videos->insert('snippet,status', $video, array(
            'data' => file_get_contents($mediapath),
            'mimeType' => 'application/octet-stream',
            'uploadType' => 'multipart'
          )
        );

        return response()->json(['video_id' => $response->id]);
    }
}
