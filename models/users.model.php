<?php

    require_once "conection.php";

    class UsersModel{

        static public function getUsers($data_users){
            $sql = "
                select s.id value, s.name label, concat(s.name,' ', s.last_name) name, 
                case when r.id = 2 then 'Docente' else 'Alumno' end type
                from partners s
                join topics_partners ds on ds.partner_id = s.id
                join topics d on d.id = ds.topic_id and topic_id = :topic_id
                join roles r on r.id = s.role_id;
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