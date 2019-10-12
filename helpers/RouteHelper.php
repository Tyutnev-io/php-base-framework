<?php

namespace app\helpers;

use Exception;

/**
 * @author Artem Tyutnev <artem.tyutnev.work@gmail.com>
 * @package app\helpers
 */
class RouteHelper
{
    /**
     * Path to controllers
     * @var string
     */
    const PATH = 'controllers/';

    /**
     * Namespace with controllers
     * @var string
     */
    const NAMESPACE = '\\app\\controllers\\';

    /**
     * @param string|array $route
     * @param array|null $args
     * @return void
     * @throws Exception
     */
    public static function execute($route, $args = null)
    {
        if(is_string($route)) $route = explode('/', $route);

        $ControllerName = array_shift($route);
        $actionName = array_shift($route);
        $pathToController = self::PATH . $ControllerName . '.php';

        if(is_null($args)) $args = $route;

        if(file_exists($pathToController))
        {
            $ControllerName = self::NAMESPACE . $ControllerName;
            call_user_func_array([new $ControllerName, $actionName], $args);
        }
        else 
        {
            throw new Exception("Controller not found in $pathToController");
        }
    }
}