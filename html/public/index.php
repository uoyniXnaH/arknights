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

// routes
$app->get('/', function ($request, $response, $args) {
    //get db settings
    $dbSetting = Settings\settings::getDbSetting();
    $view = Twig::fromRequest($request);
    $ctl = new Controllers\recruitment($dbSetting);
    $conn = $ctl->init();
    if ($conn == 1) {
        $res = $ctl->getLabels();
    } else {
        $res = $conn;
    }

    return $view->render($response, 'top.html', ["res" => $res]);
});

// Run the app
$app->run();
