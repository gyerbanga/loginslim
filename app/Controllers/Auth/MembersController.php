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
    public function espacemembres($request, $response)
    {
    	//récupérer tous les membres du club
        $amis= $this->member->getAllMembers();
        //selectionner tous les membres qui ont cotisé avec date et montant
        $cotas= $this->member->membresAjourCota();
        $stat= $this->member->getStat();

        return $this->view->render($response, 'membres.twig',
            [
        	'membres'  =>$amis,
            'cotas'    =>$cotas,
            'effectif' =>$stat['effectif'],
            'cot_max'  =>$stat['cot_max'],
            'total'    =>$stat['total'],
            'cota_min' =>$stat['cota_min'],
            'moyenne' =>$stat['moyenne'],
            'mot'      =>"Vous pouvez faire"
        ]);
    }


}