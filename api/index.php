<?php

use Fhtechnikum\Uebung34\Controller\NavigationController;
session_start();

error_reporting(E_ERROR);
ini_set("display_errors", 1);
include 'src/config/config.php';
require 'vendor/autoload.php';

$controller = new NavigationController();
$controller->route();