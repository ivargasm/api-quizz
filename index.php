<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header("Access-Control-Allow-Origin: *");  // permite las solicitudes solo desde http://localhost:5173
    header("Access-Control-Allow-Methods: GET"); // los métodos que quieres permitir
    header("Access-Control-Allow-Headers: Content-Type"); // otros encabezados que desees permitir


    require_once "controllers/views.controller.php";
    require_once "controllers/questions.controller.php";
    require_once "models/questions.model.php";
    require_once "controllers/degrees.controller.php";
    require_once "models/degrees.model.php";
    require_once "controllers/topics.controller.php";
    require_once "models/topics.model.php";
    require_once "controllers/users.controller.php";
    require_once "models/users.model.php";
    require_once "controllers/partials.controller.php";
    require_once "models/partials.model.php";
    require_once "controllers/shopping.controller.php";
    require_once "models/shopping.model.php";
    require_once "controllers/email.controller.php";

    $ruta = new ViewsController();
    $ruta -> index();

?>