<?php
 error_reporting(-1);
 ini_set('display_errors', 1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/entidades/Usuario.php';
require __DIR__ . '/AccesoDatos/AccesoDatos.php';
require __DIR__ . '/controllers/usuarioController.php';

$app = AppFactory::create();

$app->addErrorMiddleware(true,true,true);
 
$app->add(function (Request $request, RequestHandlerInterface $handler): Response {
    
    $response = $handler->handle($request);

    $requestHeaders = $request->getHeaderLine('Access-Control-Request-Headers');

    $response = $response->withHeader('Access-Control-Allow-Origin', '*');
    $response = $response->withHeader('Access-Control-Allow-Methods', 'get,post');
    $response = $response->withHeader('Access-Control-Allow-Headers', $requestHeaders);

    return $response;
});


$app->post("/", \UsuarioController::class . ':ValidarUsers' ); 

$app->group('/Register', function (RouteCollectorProxy $group) {
    $group->post('/enviar[/]', \UsuarioController::class . ':RegistrarUser' );
}); 

$app->run();