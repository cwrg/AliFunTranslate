<?php

use RingCentral\Psr7\Response;

require_once __DIR__ . '/vendor/autoload.php';

function handler($request, $context): Response
{
    $app = new \Core\App($request);
    $response = $app->run();
    return new Response(200, $app->headers(), $response);
}
