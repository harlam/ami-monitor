<?php

define('APP_ROOT', dirname(dirname(__DIR__)));

require_once APP_ROOT . '/vendor/autoload.php';

(\Dotenv\Dotenv::createMutable(APP_ROOT))->load();
