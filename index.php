<?php

    header("Access-Control-Allow-Origin: http://localhost:5173");  // permite las solicitudes solo desde http://localhost:5173
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE"); // los métodos que quieres permitir
    header("Access-Control-Allow-Headers: Content-Type"); // otros encabezados que desees permitir


    require_once "controllers/views.controller.php";
    require_once "controllers/questions.controller.php";
    require_once "models/questions.model.php";

    $ruta = new ViewsController();
    $ruta -> index();

?>