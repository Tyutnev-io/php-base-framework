<?php
/**
 * Config for the application
 */
return [
    /**
     * Setting url
     * key - URL, value - route
     * For example:
     *      'user/<arg:d+>/setting' => 'setting/index'
     *      URL: https://site.local/user/1/setting
     *      Route: $SettingController->actionIndex($arg);
     * Type arguments:
     *      d+ - integer
     *      w+ - string
     */
    'url' => [
        'post/info' => 'post/index',
        'user/<arg:d+>/setting' => 'setting/index' 
    ],
    /**
     * Language application
     */
    'lang' => 'ru',
    /**
     * Components for application
     * key - name components, value - parametrs for components
     * For example:
     *      'request' => [
     *          'class' => 'app\\components\\Request'
     *      ]
     * Access:
     *      $app = new App();
     *      $app->request; 
     */
    'components' => [
        'request' => [
            'class' => 'app\\components\\Request'
        ]
    ]
];