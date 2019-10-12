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
     * Converts url from config to regular expression
     * @see config/app.php
     * @param string
     * @return string
     */
    public static function toRegExp($pattern)
    {
        return '~' . (preg_replace('~<arg>~', '(\w+)', $pattern)) . '~';
    }

    /**
     * @param string|array $route
     * @param array|null $args
     * @return void
     * @throws Exception
     */
    public static function execute($route, $args = null)
    {
        if(is_string($route)) $route = explode('/', $route);

        $ControllerName = ucfirst(array_shift($route)) . 'Controller';
        $actionName = ucfirst(array_shift($route));
        $actionName = $actionName ? 'action' . $actionName : 'actionIndex';
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