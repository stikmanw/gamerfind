<?php
namespace GamerFind\Controllers;

use GamerFind\Controller;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login()
    {
        return $this->twig->render('auth.html.twig',['page'=>'login']);
    }

    public function signup()
    {
        return $this->twig->render('auth.html.twig',['page'=>'signup']);
    }
}