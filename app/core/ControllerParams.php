<?php

namespace app\core;

use app\routes\Routes;
use app\support\RequesType;
use app\support\Uri;

class ControllerParams
{
    private function filterParams($router)
    {
        $uri = Uri::get();
        $explodeUri = explode('/', $uri);
        $explodRouter = explode('/', $router);
        $params = [];
        foreach ($explodRouter as $index => $routerSegment) {
            if ($routerSegment !== $explodeUri[$index]) {
                $params[$index] = $explodeUri[$index];
            }
        }
        return $params;
    }

    public function get(string $router)
    {
        $uri = Uri::get();
        $routes = Routes::get();
        $requestMethod = RequesType::get();
        $router = array_search($router, $routes[$requestMethod]);
        $params = $this->filterParams($router);
        return array_values($params);
    }
}
