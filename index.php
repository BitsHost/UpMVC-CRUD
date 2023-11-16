<?php
require_once 'vendor/autoload.php';

//error_reporting(1);
use MyApp\Controllers\CrudController;
use MyApp\Models\UserModel;
use MyApp\Views\CrudView;



$crudController = new CrudController(new UserModel(), new CrudView());
$crudController->renderHeader();
$crudController->handleRequest();
$crudController->renderFooter();
?>
