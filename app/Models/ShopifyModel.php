<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ShopifyModel extends Model
{
    public static function getUserIdByHost($host) {
        return DB::table('users')
            ->where('users.name', $host)
            ->select('users.id')
            ->get();
    }

    public static function getScriptTagByShopId($shopId) {
        return DB::table('table_script_tags_app')
            ->where('table_script_tags_app.shop_id', $shopId)
            ->select('table_script_tags_app.*')
            ->get();
    }

    public static function setScriptTagByShopId($shopId, $response) {
        return DB::table('table_script_tags_app')
            ->insert([
                'script_tag_id' => $response["body"]->container["script_tag"]["id"],
                'shop_id' => $shopId,
                'created_at' => Carbon::now()->addHours(3)
            ]);
    }
}
