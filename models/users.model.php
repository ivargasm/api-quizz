<?php

    require_once "conection.php";

    class UsersModel{

        static public function getUsers($data_users){
            $sql = "
                select s.id value, s.name label from users s
                join topics_users ds on ds.user_id = s.id
                join topics d on d.id = ds.topic_id and topic_id = :topic_id;
            ";

            $stmt = Conexion::conectar()->prepare($sql);
            $stmt -> bindParam(":topic_id", $data_users, PDO::PARAM_STR);
            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);

            $stmt -> close();
            $stmt = null;
        }
    }

?>