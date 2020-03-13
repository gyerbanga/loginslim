<?php
/* https://openclassrooms.com/fr/courses/1811341-decouvrez-le-framework-php-laravel-ancienne-version/1929791-query-builder illuminate */

session_start();
require __DIR__ . '/../vendor/autoload.php';

use Respect\Validation\Validator as validator;


//instanciation des valeurs par défaut
$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'atsb',
            'username' => 'innodev',
            'password' => 'Kr47052016!',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ],
        'debug' => true,
        'determineRouteBeforeAppMiddleware' => true,
        'addContentLengthHeader' => false,
        /*'cookies.secure' => false,
         'cookies.lifetime' => '20 minutes',*/
    ],
]);

/* Configuration des éléments instanciés*/
//http://www.slimframework.com/docs/v2/configuration/settings.html
/*$app->config('cookies.lifetime', '20 minutes');
$app->config('cookies.secure', false);*/

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule) {
    return $capsule;
};

$container['auth'] = function ($container) {
    return new \App\Auth\Users;
};

$container['member'] = function ($container) {
    return new \App\Auth\Membre;
};
$container['flash'] = function () {
             return new \Slim\Flash\Messages();
         };
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
        'cache' => false,
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));


    $view->getEnvironment()->addGlobal('auth', [
        'check' => $container->auth->check(),
        'user' => $container->auth->user()
    ]);


    $view->getEnvironment()->addGlobal('flash',$container->flash);

    return $view;
};

$container['validator'] = function ($container) {
    return new App\Validation\Validator;
};

$container['HomeController'] = function ($container) {
    return new \App\Controllers\HomeController($container);
};

$container['AuthController'] = function ($container) {
    return new \App\Controllers\Auth\AuthController($container);
};

$container['SidebarController'] = function ($container) {
    return new \App\Controllers\SidebarController($container);
};

$container['MembersController'] = function ($container) {
    return new \App\Controllers\Auth\MembersController($container);
};
$container['InscripmembresController'] = function ($container) {
    return new \App\Controllers\Auth\InscripmembresController($container);
};

$container['PasswordController'] = function ($container) {
    return new \App\Controllers\Auth\PasswordController($container);
};

$container['csrf'] = function ($container) {
    return new \Slim\Csrf\Guard;
    $guard->setFailureCallable(function ($request, $response, $next) {
        $request = $request->withAttribute("csrf_status", false);
        return $next($request, $response);
    });
    return $guard;
};

// mail sender (swift_mailer)
$container['mailer'] = function($container){

      if ($container->debug)
      {
        //create the transport
        //$transport = (new Swift_SmtpTransport('smtp.example.org', 25))
        $transport = Swift_SmtpTransport::newInstance('localhost',1025);
      }else
      {
        $transport = Swift_Transport::newInstance();
      }
      $mailer = Swift_Mailer::newInstance($transport);
      return $mailer;
};

$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \App\Middleware\OldInputMiddleware($container));
$app->add(new App\Middleware\CsrfViewMiddleware($container));
//$app->add(new App\Middleware\MembersMiddleware($container));


$app->add($container->csrf);


validator::with('App\\Validation\\Rules\\');


require __DIR__ . '/../app/routes.php';
