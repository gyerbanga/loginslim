<?php

namespace App\Middleware;


use Slim\Http\Request;
use Slim\Http\Response;

class AuthMiddleware extends Middleware
{

    public function __invoke(Request $request, Response $response, $next)
    {

        if (!$this->container->auth->check()){
            //$this->container->flash->addMessage('error','Veuillez vous connecter avant de le faire');
            return $response->withRedirect($this->container->router->pathFor('auth.signin'));
        }

        $response = $next($request, $response);
        return $response;
    }
}