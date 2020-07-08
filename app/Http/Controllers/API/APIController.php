<?php

namespace App\Http\Controllers\API;

use App\Classes\Instagram;
use App\Classes\Theme;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIController extends Controller
{
    public function getPosts(Request $request) {

        $instagram = new Instagram();
        $shopId = Theme::getInstance()->getUserIdByHost($request->get('host'))[0]->id ?? [];

        if (empty($shopId))
            return [];

        $postIds = $instagram->getPostIds($shopId);
        $posts = $instagram->getPosts($shopId, 8, $postIds);


        return json_encode($posts);
    }
}
