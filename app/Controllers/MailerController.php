<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;
use Respect\Validation\Validator as Validator;


class MailerController extends Controller
{
	public function postContact(Request $request, Response $response)
	{

		$nom= $request->getParam('nom');
		$mdp= $request->getParam('password');
	    $message = Swift_Message::newInstance('Message de contact')
	                ->setFrom([$request->getParam('mail') => $request->getParam('nom')])
	                //->setTo('yerbangag@yahoo.fr.fr')
	                ->setTo('yerbangag@yahoo.fr.fr')
	                ->setBody("Un email vous a été envoyé");
	             /*   ->setBody("Un email vous a été envoyé :
	            {$request->getParam('content')}");*/
	            $retour=$this->mailer->send($message);
	            $this->flash('Votre message a bien été envoyé');
	            return $retour;
	            //return $this->redirect($response, 'contact');
	  }
}