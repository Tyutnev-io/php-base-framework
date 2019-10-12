<?php

use app\helpers\RouteHelper;

/**
 * Router for application
 * Controller Definition and Actions
 * 
 * Standard path:
 *      URL: https://site.local/post
 *      Route: $PostController->actionIndex();
 * 
 *      URL: https://site.local/post/index
 *      Route: $PostController->actionIndex();
 * 
 *      URL: https://site.local/post/detail/1
 *      Route: $PostController->actionDetail($arg)
 * 
 * 
 * The path to the controller and action can be specified in config/app.php
 * 
 * @author Artem Tyutnev <artem.tyutnev.work@gmail.com>
 * @package core
 */
class Router
{
    /**
     * Current URL
     * @var array|null
     */
    private $url;

    /**
     * Routes from config/app.php
     * @var array
     */
    private $routes;

    /**
     * Components from config/app.php
     * @var array
     */
    private $components;

    /**
     * Define URL from $_GET['url'] 
     * @see .htaccess
     */
    private function defineUrl()
    {
        $this->url = isset($_GET['url']) ? explode('/', $_GET['url']) : null;
    }

    /**
     * Define config from config/app.php
     * @param array config
     */
    private function defineConfig($config)
    {
        $this->routes = $config['url'];
        $this->components = $config['components'];
    }

    /**
     * Define args in URL
     * If the route is defined in the configuration
     * @param string
     * @return array
     */
    private function defineArgs($urlPattern)
    {
        return [];
    }

    /**
     * Checks if a given URL has a route in config/app.php
     * If route exists, then run the route
     * @return true|false
     * @throws Exception
     */
    private function findRoute()
    {
        $url = '~' . implode('/', $this->url) . '~';

        foreach($this->routes as $urlPattern => $route)
        {
            if(preg_match($url, $urlPattern))
            {
                RouteHelper::execute($route, $this->defineArgs($url));
                return true;
            }
        }
        return false;
    }

    /**
     * Home page
     * Route: $SiteController->actionIndex();
     * @return true
     * @throws Exception
     */
    private function homePage()
    {
        RouteHelper::execute(['SiteController', 'actionIndex']);
        return true;
    }

    /**
     * Run application
     * @param array
     * @return void
     * @throws Exception
     */
    public function run($config)
    {
        $this->defineUrl();
        $this->defineConfig($config);

        if(is_null($this->url) && $this->homePage()) return;
        if($this->findRoute()) return;

        RouteHelper::execute($this->url, $this->url);
    }
}