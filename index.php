<?php
require_once 'vendor/autoload.php';

//error_reporting(1);
use MyApp\Controllers\UserController;
use MyApp\Models\UserModel;
use MyApp\Views\UserView;



$crudController = new UserController(new UserModel(), new UserView());
$crudController->renderHeader();
$crudController->handleRequest();
$crudController->renderFooter();
?>
