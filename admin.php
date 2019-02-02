<?php
session_start();

require('controller/backend/Router.php');

$router = new Router();
$router->routeRequest();