<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
use Illuminate\Support\Facades\DB;

$app->get('/', 'HomeController:index')->setName('home');

$app->get('/membres', 'MembersController:espacemembres')->setName('membres');


$app->get('/api/flights/{id}', function ($id) {
		$users = DB::table('users')->get();
		$user="ouii";
	return $users;
    //return App\Models\User::findOrFail($id);
});

/**
   groupe de routage auquel les clients ont accès
 */
$app->group('',function (){

    $this->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
    $this->post('/auth/signup', 'AuthController:postSignUp');

    $this->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');
    $this->post('/auth/signin', 'AuthController:postSignIn');
    //$this->get('/delete', 'AuthController:delete2')->setName('suppress');

})->add(new GuestMiddleware($container));


$app->group('',function (){

    $this->get('/membres/inscription', 'InscripmembresController:getInscription')->setName('member.inscription');
    $this->post('/membres/inscription', 'InscripmembresController:postInscription');

})->add(new GuestMiddleware($container));
/**
 * groupe de routage auquel les utilisateurs connectés ont accès
 */
$app->group('',function (){

    $this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');

    $this->get('/auth/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
    $this->post('/auth/password/change', 'PasswordController:postChangePassword');
})->add(new AuthMiddleware($container));

