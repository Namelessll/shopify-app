<?php

namespace App\Http\Controllers\Main;

use App\Classes\Instagram;
use App\Classes\Theme;
use App\Http\Controllers\Controller;
use App\Models\InstagramModel;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopifyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth.shopify']);
    }

    public function getMainPage() {
        $instagram = new Instagram();

        if (!empty(Auth::id())) {
            Theme::getInstance()->createSection('instagram');
            Theme::getInstance()->createScriptTag(Auth::id());
        }


        if (!empty(Auth::id())) {
            //if (Carbon::parse(InstagramModel::getAccessToken(Auth::id())[0]->created_at)->diffInSeconds(Carbon::now()) > 5184000)
            if (InstagramModel::getAccessToken(Auth::id())[0]->token_type == 'none') {
                $ch = curl_init();
                $instController = new InstagramController();

                curl_setopt($ch, CURLOPT_URL, 'https://graph.instagram.com/access_token?grant_type=ig_exchange_token&client_secret='.$instController::getClientSecretKey().'&access_token='.InstagramModel::getAccessToken(Auth::id())[0]->access_token);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                $result = curl_exec($ch);
                curl_close($ch);
                //dd(json_decode($result));
            }
        }

        try {
            $data['user'] = $instagram->getUser(Auth::id());
            if (InstagramModel::checkTime(Auth::id())) {
                $postIds = $instagram->getPostIds(Auth::id());
                $posts = $instagram->getPosts(Auth::id(), 8, $postIds);
                InstagramModel::savePosts(Auth::id(), $posts);
            } else {
                $posts = InstagramModel::getPosts(Auth::id());
            }


            $data['posts'] = $posts;
            //dd($posts);

        } catch (\Throwable $e) {
            $data['error'] = "Error validating access token: The user has not authorized application ". config('app.instagram_client_id') .". ";
        }

        return view('welcome', $data);
    }

}
