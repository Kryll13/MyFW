<?php
require_once __DIR__ . '/vendor/autoload.php';

use MyFW\Core\Launcher;
use MyFW\Core\Request;

Launcher::run(new Request());