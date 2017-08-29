<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 11/08/2017
 * Time: 13:08
 */

// For good path purpose
const ROOT_DIR = __DIR__ . '/../';

// Composer autoload
require_once __DIR__ . '/../vendor/autoload.php';

// Running the app
$app = new JHD\app\Application();
$app->run();