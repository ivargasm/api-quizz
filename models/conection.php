<?php

    class Conexion{

        static public function conectar(){

            $DB_HOST = getenv('DB_HOST');
            $DB_NAME = getenv('DB_NAME');
            $DB_USER = getenv('DB_USER');
            $DB_PASS = getenv('DB_PASS');  // Si has definido la variable de entorno, descomenta esta línea
            // $DB_PASS = "";
            $DB_PORT = getenv('DB_PORT');

            print_r($_ENV['DB_HOST']);
            print_r($DB_NAME);
            print_r($DB_USER);
            print_r($DB_PASS);
            print_r($DB_PORT);

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