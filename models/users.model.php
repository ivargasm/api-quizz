<?php

    require_once "conection.php";

    class UsersModel{

        static public function getUsers($data_users){
            $sql = "
                select s.id value, s.name label from users s
                join degrees_users ds on ds.user_id = s.id
                join degrees d on d.id = ds.degree_id and degree_id = :degree_id;
            ";

            $stmt = Conexion::conectar()->prepare($sql);
            $stmt -> bindParam(":degree_id", $data_users, PDO::PARAM_STR);
            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);

            $stmt -> close();
            $stmt = null;
        }
    }

?>