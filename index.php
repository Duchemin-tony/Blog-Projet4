<?php
session_start();

require('controller/frontend/Router.php');

$router = new Router();
$router->routeRequest();