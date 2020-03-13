<?php

namespace App\Middleware;


use Slim\Http\Request;
use Slim\Http\Response;

class MembersMiddleware extends Middleware
{

    public function __invoke(Request $request, Response $response, $next)
    {

        if (!$this->container->auth->check()){
            $this->container->flash->addMessage('error','Ce membre ne fait pas partie du club');
            return $response->withRedirect($this->container->router->pathFor('membres'));
        }

        $response = $next($request, $response);
        return $response;
    }
}