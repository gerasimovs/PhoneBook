<?php

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

$response = $app->handle(
    \Symfony\Component\HttpFoundation\Request::createFromGlobals()
);

$response->send();
