<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InstagramModel extends Model
{

    public static function insertOrUpdate($userId, $request) {
        return DB::table('table_instagram_access')
            ->updateOrInsert([
               'profile_id' => $userId,
               'user_id' => $request->user_id
            ],
            [
                'profile_id' => $userId,
                'access_token' => $request->access_token,
                'user_id' => $request->user_id,
                'created_at' => Carbon::now(),
            ]);
    }

    public static function getAccessToken($userId) {
        return DB::table('table_instagram_access')
            ->where('table_instagram_access.profile_id', $userId)
            ->select('table_instagram_access.*')
            ->get();
    }

    public static function checkTime($shopId) {
        $lastUpdate = DB::table('table_instagram_cron')
            ->where('table_instagram_cron.shop_id', $shopId)
            ->select('table_instagram_cron.created_at')
            ->get();

        $lastUpdate = $lastUpdate[0]->created_ar ?? null;

        if ($lastUpdate != null)
            if (Carbon::parse($lastUpdate)->diffInMinutes(Carbon::now()) < 5)
                return false;

        DB::table('table_instagram_cron')
            ->updateOrInsert(
                [
                    'shop_id' => $shopId
                ],
                [
                    'shop_id' => $shopId,
                    'created_at' => Carbon::now()
                ]
            );

        return true;
    }

    public static function savePosts($shopId, $response) {
        if (self::checkTime($shopId))
            foreach ($response as $item)
                DB::table('table_instagram_posts')
                    ->Insert(
                        [
                            'shop_id' => $shopId,
                            'post_caption' => $item["caption"],
                            'post_media_url' => $item["media_url"],
                            'post_username' => $item["username"],
                        ]
                    );
    }

    public static function getPosts($shopId) {
        return DB::table('table_instagram_posts')
            ->where('table_instagram_posts.shop_id', $shopId)
            ->select('table_instagram_posts.*')
            ->get();
    }
}
