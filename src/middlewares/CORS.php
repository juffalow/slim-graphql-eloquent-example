<?php

namespace middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class CORS {
  public function __invoke(Request $request, Response $response, callable $next) {
    $response = $response->withHeader('Access-Control-Allow-Origin', '*');
    $response = $response->withHeader('Access-Control-Allow-Headers', 'Authorization,Content-Type');
    $response = $response->withHeader('Access-Control-Allow-Methods', 'GET,POST,OPTIONS,DELETE,PUT');
    $response = $response->withHeader('Access-Control-Max-Age', '600');
    $response = $response->withHeader('Access-Control-Allow-Credentials', 'true');

    return $next($request, $response);
  }
}
