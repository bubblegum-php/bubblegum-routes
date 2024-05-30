<?php

namespace Bubblegum\Routes;

class RouteJunction
{
    public static function getRouteConfig(): ?RouteConfig
    {
        /* @var RouteConfig[] $routeConfigs */
        $routeConfigs = Route::getRouteConfigs()[$_SERVER['REQUEST_METHOD']];
        $uri = self::clearedUri();
        foreach ($routeConfigs as $routeConfig) {
            if (self::compare($routeConfig, $uri)) {
                return $routeConfig;
            }
        }
        return null;
    }

    public static function clearedUri(): string
    {
        return trim($_SERVER['REQUEST_URI'], '/');
    }

    public static function compare(RouteConfig $routeConfig, string $uri): string
    {
        return preg_match($routeConfig->getRegexPattern(), $uri);
    }
}