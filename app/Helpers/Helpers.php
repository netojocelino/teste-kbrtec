<?php

namespace App\Helpers;

class Helpers
{
    public static function active (string $routeName, string $className = 'active')
    {
        return self::isActive($routeName)
            ? $className
            : '';
    }

    public static function isActive(string $routeName)
    {
        $routeNameBase = array_filter(explode("*", $routeName));
        $routeNameCompare = $routeNameBase[array_key_first($routeNameBase)];
        $currentRouter = request()->route()->getName();

        return (str_contains($currentRouter, $routeNameCompare) || $currentRouter === $routeNameCompare);
    }
}
