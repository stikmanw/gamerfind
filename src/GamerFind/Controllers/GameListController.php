<?php
namespace GamerFind\Controllers;

use GamerFind\Controller;
use Symfony\Component\HttpFoundation\Response;
use GamerFind\Services\GamerList\Client;

class GameListController extends Controller
{
    public function getGames()
    {
        $api = new Client();
        return new Response($api->getGames(null, "PC"));
    }

}