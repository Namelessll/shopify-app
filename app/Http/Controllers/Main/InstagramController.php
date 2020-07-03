<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\InstagramModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class InstagramController extends Controller
{
    private static $clientId;
    private static $clientSecretKey;
    private static $authRedirect;

    public function __construct()
    {
        self::$clientId = config('app.instagram_client_id');
        self::$clientSecretKey = config('app.instagram_secret_key');
        self::$authRedirect = config('app.instagram_auth_redirect');
    }

    public function instagramConnectRoute() {
        return redirect()->to('https://api.instagram.com/oauth/authorize?client_id='.self::$clientId.'&redirect_uri='.self::$authRedirect.'&scope=user_profile,user_media&response_type=code');
    }

    public function instagramCallbackRoute(Request $request) {
        $ch = curl_init();

        $data = [
            'client_id'     => self::$clientId,
            'client_secret' => self::$clientSecretKey,
            'grant_type'    => 'authorization_code',
            'redirect_uri'  => self::$authRedirect,
            'code'          => $request->get('code')
        ];
        curl_setopt($ch, CURLOPT_URL, 'https://api.instagram.com/oauth/access_token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $result = curl_exec($ch);
        curl_close($ch);

        InstagramModel::insertOrUpdate(Auth::id(), json_decode($result));
        return Redirect::away('/');
    }

}
