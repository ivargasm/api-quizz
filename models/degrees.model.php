<?php

    require_once "conection.php";

    class DegreesModel{

        static public function getDegrees(){
            print_r("entre al modelo");

            $sql = "SELECT id as 'value', description as 'label' FROM degrees";

            $stmt = Conexion::conectar()->prepare($sql);
            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);

            $stmt -> close();
            $stmt = null;

        }

    }

?>