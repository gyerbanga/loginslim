<?php

/* https://laravel.com/docs/7.x/eloquent */
/* https://code.i-harness.com/fr/docs/laravel~5.7/docs/5.7/queries */
namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\Members;
use Slim\Http\Request;
use Slim\Http\Response;
use Respect\Validation\Validator as Validator;


class InscripmembresController extends Controller
{

     public function getInscription(Request $request,Response $response)
     {
        return $this->view->render($response,'membres/membresinscrit.twig');
    }

    public function postInscription(Request $request, Response $response)
    {
        $validation = $this->validator->validate($request, [
            'mail'     => Validator::noWhitespace()->notEmpty()->email()->emailAvailable(),
            'nom'      => Validator::noWhitespace()->notEmpty(),
            'prenom'   => Validator::noWhitespace()->notEmpty(),
            'civilite' => Validator::noWhitespace()->notEmpty(),
            'adresse'  => Validator::noWhitespace()->notEmpty(),
            'cp'       => Validator::noWhitespace()->notEmpty(),
            'ville'    => Validator::noWhitespace()->notEmpty(),
            'pays'    => Validator::noWhitespace()->notEmpty(),
            'tel1'     => Validator::noWhitespace()->notEmpty(),
            'tel2'     => Validator::noWhitespace()->notEmpty(),
        ]);
        /**  auth.signup  : auth/signup.twig   getSignUp
         * Si des erreurs sont définies, la fonction renvoie true dans les erreurs, puis elle redirige
         */
        if (!$validation->failed()) {
            $this->flash->addMessage('warning',' Mauvaise saisie. Vérifier la saisie de certains champs !');
            return $response->withRedirect($this->router->pathFor('member.inscription'));
        }

        //on sauvegarde les données saisies:
        $user = Members::create([
            'nom'           => $request->getParam('nom'),
            'prenom'        => $request->getParam('prenom'),
            'civilite'      => $request->getParam('civilite'),
            'adresse'       => $request->getParam('adresse'),
            'cp'            => $request->getParam('cp'),
            'ville'         => $request->getParam('ville'),
            'tel1'          => $request->getParam('tel1'),
            'mail'          => $request->getParam('email'),
            'adhesion_date' => $request->getParam('adhesion_date'),
            'message'       => $request->getParam('tel2'),
        ]);

        /**
         * message flash ajouté
         */
        $this->flash->addMessage('info','Votre inscription a été prise en compte ! Vous pouvez maintenant créer votre compte espace pour accéder aux données du club');

        $this->auth->email($request->getParam('nom'));

        return $response->withRedirect($this->router->pathFor('auth.signup'));
    }

}