<?php


namespace App\Classes;


use App\Classes\libs\Options;
use App\Models\ShopifyModel;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class Theme extends Options
{
    private static $_instance;

    private function __construct() {}

    public static function getInstance() {
        if (self::$_instance === null)
            self::$_instance = new self;

        return self::$_instance;
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    private function __wakeup()
    {
        // TODO: Implement __wakeup() method.
    }

    public function createSection($sectionCode) {
        $activeThemeId = Options::getMainThemeId(Auth::user());

        $section = Options::getSectionLiquid();
        $array = array('asset' => array('key' => 'sections/'.$sectionCode.'-shopify-app.liquid', 'value' => $section));

        return Options::setNewSection(Auth::user(), $activeThemeId, $array);
    }

    public function createScriptTag($shop) {
        if (count(ShopifyModel::getScriptTagByShopId($shop)) < 1) {
            $array = array(
                'script_tag' => array(
                    'event' => 'onload',
                    'src' => str_replace('http', 'https', url('/')) . '/js/instagram-script.js',
                )
            );

            $response = Options::setNewScriptTag(Auth::user(), $array);
            return ShopifyModel::setScriptTagByShopId(Auth::id(), $response);
        } else {
            return false;
        }
    }

    public function getUserIdByHost ($host){
        return Options::getUserIdBySiteHost($host);
    }


}
