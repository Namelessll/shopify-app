<?php

namespace App\Models;

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
                'user_id' => $request->user_id
            ]);
    }

    public static function getAccessToken($userId) {
        return DB::table('table_instagram_access')
            ->where('table_instagram_access.profile_id', $userId)
            ->get();
    }
}
