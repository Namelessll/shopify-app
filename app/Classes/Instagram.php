<?php


namespace App\Classes;


use App\Models\InstagramModel;
use GuzzleHttp\Client;

class Instagram
{
    private $access_token;
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://graph.instagram.com',
        ]);
    }
    private function setAccessToken($token) {
        $this->access_token = $token;
    }

    public function getUser($userId){
        $this->setAccessToken(InstagramModel::getAccessToken($userId)[0]->access_token);
        if($this->access_token){
            $response = $this->client->request('GET', '/me', [
                'query' => [
                    'fields' => 'id,username',
                    'access_token' =>  $this->access_token
                ]
            ]);
            return json_decode($response->getBody()->getContents());
        }
        return [];
    }

    public function getPostIds($userId) {
        $this->setAccessToken(InstagramModel::getAccessToken($userId)[0]->access_token);
        if ($this->access_token){
            $response = $this->client->request('GET', '/me/media', [
                'query' => [
                    'fields' => 'id,caption',
                    'access_token' =>  $this->access_token
                ]
            ]);
            return json_decode($response->getBody()->getContents())->data;
        }
        return [];
    }

    public function getPosts($userId, $limit, $postIds) {
        $this->setAccessToken(InstagramModel::getAccessToken($userId)[0]->access_token);
        if ($this->access_token){
            $posts = [];
            foreach(array_slice($postIds, 0, $limit) as $postId) {
                $response = $this->client->request('GET', '/'.$postId->id, [
                    'query' => [
                        'fields' => 'id,media_type,media_url,username,timestamp',
                        'access_token' =>  $this->access_token
                    ]
                ]);
                $response = json_decode($response->getBody()->getContents());
                $posts[] = [
                    "caption" => $postId->caption ?? "",
                    "media_url" => $response->media_url,
                    "username" => $response->username
                ];

            }
            return $posts;
        }
        return [];
    }


}
