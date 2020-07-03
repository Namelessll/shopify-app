<?php

namespace App\Http\Controllers\Main;

use App\Classes\Instagram;
use App\Http\Controllers\Controller;
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

        try {
            $data['user'] = $instagram->getUser(Auth::id());
            $postIds = $instagram->getPostIds(Auth::id());
            $posts = $instagram->getPosts(Auth::id(), 8, $postIds);
            $data['posts'] = $posts;
        } catch (\Throwable $e) {
            $data['error'] = "Error validating access token: The user has not authorized application ". config('app.instagram_client_id') .". ";
        }

        return view('welcome', $data);
    }
}
