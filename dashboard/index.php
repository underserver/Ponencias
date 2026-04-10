<?php
// Entry point for the Dashboard

require_once __DIR__ . '/../vendor/autoload.php';

use Ponencias\Dashboard\Main;

$dashboard = new Main();
$dashboard->render();

