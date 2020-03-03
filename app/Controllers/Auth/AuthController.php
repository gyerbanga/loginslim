<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;
use Respect\Validation\Validator as Validator;


class AuthController extends Controller
{

    public function getSignOut(Request $request, $response)
    {
        $this->auth->logout();
        $this->flash->addMessage('success','Vous avez été déconnecté !');
        return $response->withRedirect($this->router->pathFor('home'));
    }


    public function getSignUp(Request $request, $response)
    {
        return $this->view->render($response, 'auth/signup.twig');
    }

    public function postSignUp(Request $request, Response $response)
    {
        $validation = $this->validator->validate($request, [
            'email' => Validator::noWhitespace()->notEmpty()->email()->emailAvailable(),
            'name' => Validator::noWhitespace()->notEmpty()->alpha(),
            'password' => Validator::noWhitespace()->notEmpty(),
        ]);
        /**
         * Si des erreurs sont définies, la fonction renvoie true dans les erreurs, puis elle redirige
         */
        if ($validation->failed()) {
            $this->flash->addMessage('warning',' Mauvaise saisie !');
            return $response->withRedirect($this->router->pathFor('auth.signup'));
        }


        $user = User::create([
            'email' => $request->getParam('email'),
            'name' => $request->getParam('name'),
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
        ]);

        /**
         * message flash ajouté
         */
        $this->flash->addMessage('info','Votre inscription a été prise en compte !');

        /**
         * Après avoir créé le compte, il se connecte immédiatement au compte
         * prend l'e-mail de l'objet utilisateur créé et le mot de passe de l'entrée envoyée dans le formulaire
         */
        $this->auth->attempt($user->email, $request->getParam('password'));

        return $response->withRedirect($this->router->pathFor('home'));
    }

    public function getSignIn(Request $request, $response)
    {

        return $this->view->render($response, 'auth/signin.twig');
    }

    public function postSignIn(Request $request, $response)
    {

        $auth = $this->auth->attempt(
            $request->getParam('email'),
            $request->getParam('password')
        );

        /**
         * Si la classe Auth est définie sur false (mot de passe incorrect), redirigez-la vers la page de connexion
         */
        if (!$auth) {
            $this->flash->addMessage('error','Impossible de se connecter avec ces identifiants');
            return $response->withRedirect($this->router->pathFor('auth.signin'));
        }
        $this->flash->addMessage('success','Vous êtes connecté !');
        /**
         * sinon, si le mot de passe correspond à la redirection vers la page d'accueil home
         */
        return $response->withRedirect($this->router->pathFor('home'));
    }

}