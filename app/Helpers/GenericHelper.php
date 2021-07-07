<?php

namespace App\Helpers;


class GenericHelper {
    static function getNamedRoutes() {
        $allRoutes = \Route::getRoutes()->getRoutesByName();
        $routes = [];

        /* @var $route \Illuminate\Routing\Route  */
        foreach($allRoutes as $name => $route) {
            $routes[$name] = "/{$route->uri}";
        }

        return $routes;
    }
}

