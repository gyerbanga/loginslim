<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Member;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

class SidebarController extends Controller
{

    public function historique($request, $response)
    {
        return $this->view->render($response, 'sidebar/historique.twig');
    }

    public function contacter($request, $response)
    {
        return $this->view->render($response, 'sidebar/contact.twig');
    }
}