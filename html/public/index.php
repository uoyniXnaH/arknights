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
    $view = Twig::fromRequest($request);
    $ctl = new Controllers\recruitment();
    $conn = $ctl->init();
    if ($conn == 1) {
        $res = $ctl->getLabelByType();
    } else {
        $res = "Error";
    }

    return $view->render($response, 'recruitment.html', ["res" => $res]);
});

// api route
$app->group('/api', function ($group) {
    $group->get('/labels', function ($request, $response, $args) {
        $param = $request->getQueryParams();
        if ($param['type'] == 'all') {
            $ctl = new Controllers\recruitment();
            $ctl->init();
            $res = $ctl->getLabelByType();
        } elseif ($param['type']) {
            $ctl = new Controllers\recruitment();
            $ctl->init();
            $res = $ctl->getLabelByType($param['type']);
        } else {
            return $response->withStatus(400);
        }
        $response->getBody()->write(json_encode($res));
        $response = $response->withStatus(200);
        return $response->withHeader('Content-Type', 'application/json;charset=utf8');
    });
});

// resource files route
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
