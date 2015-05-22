<?php
namespace GamerFind\Services\GamerList;

use GuzzleHttp\Client as Guzzle;
use Predis;

class Client
{
    /**
     * @var Predis\Client
     */
    protected $redisClient;

    public function getGames($name = null, $platform = null, $genre = null)
    {
        $key = "getGames-" . md5(json_encode(func_get_args()));
        $xml = $this->getCache($key);
        if(!$xml) {
            $http = new Guzzle();
            $resp = $http->get(Settings::gamerList($name, $platform, $genre));
            $xml = $resp->getBody();
            $result = $this->xmlToArray($xml);
            $this->cache($key, json_encode($result));
        } else {
            $result = json_decode($xml);
        }

        foreach($result as $myArray) {
            foreach($myArray as $game) {
                $this->addGame($platform, $game);
            }
        }
    }

    public function xmlToArray($xml)
    {
        $xml = simplexml_load_string($xml);
        $json = json_encode($xml);
        return json_decode($json,TRUE);
    }

    public function cache($key, $response)
    {
        $client = $this->getRedisClient();
        $client->set($key, $response);
    }

    public function getCache($key)
    {
        $client = $this->getRedisClient();
        return $client->get($key);
    }

    public function recentlyProcessed($caller)
    {
        return (time() - $this->redisClient->get($caller) > 500);
    }

    public function setProcessed($caller)
    {
        $client = $this->getRedisClient();
        $client->set($caller, time());
    }

    public function getRedisClient()
    {
        if(! $this->redisClient instanceof Predis\Client) {
            $this->redisClient = new Predis\Client();
        }

        return $this->redisClient;
    }

    public function addGame($platform, $game)
    {
        if(!$game->ReleaseDate) {
            $game->ReleaseDate = "unknown"; 
        }

        $gameName = $game->GameTitle . " (" . $game->ReleaseDate . ")";
        $client = $this->getRedisClient();
        $client->executeRaw(['ZADD', "games:{$platform}", 0, $gameName]);
    }
}
