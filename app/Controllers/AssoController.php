<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Member;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

class AssoController extends Controller
{

    public function historique($request, $response)
    {
        return $this->view->render($response, 'auth/historique.twig');
    }
}