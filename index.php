<?php
require 'vendor/autoload.php';
require 'core/Router.php';

(new Router)->run(require 'config/app.php');