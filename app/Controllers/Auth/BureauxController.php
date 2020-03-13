<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\Members;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

class MembersController extends Controller
{
	/**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
  /*  public function getMembers()
    {
        $users = DB::table('users')->get();

        return $users;
    }
*/
    public function bureau($request, $response)
    {
    	//récupérer tous les membres du club
        $bureaux= $this->member->getAllMembers();

        return $this->view->render($response, 'membres.twig',
            [
        	'bureaux'  =>$bureau,
        ]);
    }


}