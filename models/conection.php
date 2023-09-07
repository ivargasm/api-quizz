<?php

    if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1') {
        $rootDirectory = $_SERVER['DOCUMENT_ROOT'] . '/api-quizz/';
    } else {
        $rootDirectory = $_SERVER['DOCUMENT_ROOT'];
    }
    
    require $rootDirectory . 'vendor/autoload.php';  // Asegúrate de incluir el autoload de Composer al inicio de tu script

    // Carga las variables de entorno desde .env
    $dotenv = Dotenv\Dotenv::createImmutable($rootDirectory);
    $dotenv->load();

    class Conexion{

        static public function conectar(){

            $DB_HOST = $_ENV['DB_HOST'];
            $DB_NAME = $_ENV['DB_NAME'];
            $DB_USER = $_ENV['DB_USER'];
            $DB_PASS = $_ENV['DB_PASS'];
            $DB_PORT = $_ENV['DB_PORT'];


            try {
                $link = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;port=$DB_PORT", $DB_USER, $DB_PASS);
                $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
                            

            $link->exec("set names utf8");

            return $link;
        }

    }

?>