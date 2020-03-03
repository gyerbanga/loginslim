<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator as Validator;
use Slim\Http\Request;
use Slim\Http\Response;


class PasswordController extends Controller
{

    public function getChangePassword(Request $request,Response $response){
        return $this->view->render($response,'auth/password/change.twig');
    }

    public function postChangePassword(Request $request,Response $response){

        $validation = $this->validator->validate($request, [
            'password_old' => Validator::noWhitespace()->notEmpty()->matchesPassword($this->auth->user()->password),
            'password' => Validator::noWhitespace()->notEmpty(),
        ]);

        if ($validation->failed()) {
            //$this->flash->addMessage('warning','something\'s went wrong !');
            return $response->withRedirect($this->router->pathFor('auth.password.change'));
        }
        $this->auth->user()->setPassword($request->getParam('password'));

        $this->flash->addMessage('info','Votre mot de passe a été changé');

        return $response->withRedirect($this->router->pathFor('home'));
    }


}