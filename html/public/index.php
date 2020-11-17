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

// view route
$app->get('/recruitment', function ($request, $response, $args) {
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

// view resource files
$app->get('/css/{file}', function ($request, $response, $args) {
    $file = "css/" . $args['file'];
    if ($data = file_get_contents($file)) {
        $response->getBody()->write($data);
        return $response->withHeader('Content-Type', 'text/css');
    } else {
        return $response->withStatus(404);
    }
});

$app->get('/js/{file}', function ($request, $response, $args) {
    $file = "js/" . $args['file'];
    if ($data = file_get_contents($file)) {
        $response->getBody()->write($data);
        return $response->withHeader('Content-Type', 'text/javascript');
    } else {
        return $response->withStatus(404);
    }
});

$app->get('/img/{file}', function ($request, $response, $args) {
    $file = "img/" . $args['file'];
    if ($data = file_get_contents($file)) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $contenttype = finfo_file($finfo, $file);
        finfo_close($finfo);
        $response->getBody()->write($data);
        return $response->withHeader('Content-Type', $contenttype);
    } else {
        return $response->withStatus(404);
    }
});

// Run the app
$app->run();
