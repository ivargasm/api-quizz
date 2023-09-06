<?php

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

    $ruta = new ViewsController();
    $ruta -> index();

?>