<?php

namespace mywishlist\controllers;
use Slim\Http\Response;

class Controller {
    protected  $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function redirect($response, $name, $path = [], $param = []) {
        return $response->withRedirect($this->container->router->pathFor($name, $path, $param));
    }
}