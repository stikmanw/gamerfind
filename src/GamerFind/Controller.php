<?php

namespace GamerFind;

use Symfony\Component\HttpFoundation\Response;

class Controller
{
    protected $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }
}