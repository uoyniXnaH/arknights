<?php

use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require __DIR__ . '/../vendor/autoload.php';

// Create App
$app = AppFactory::create();

// Create Twig
$twig = Twig::create(__DIR__ . '/../src/views',
    ['cache' => false]);

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));

// Example route
// Please note how $view is created from the request
$app->get('/', function ($request, $response, $args) {
    $view = Twig::fromRequest($request);
    $ctl = new Controllers\testCls("333");
    $res = $ctl->getVal();
    return $view->render($response, 'top.html', [
        'assign' => $res
    ]);
});

// Run the app
$app->run();
