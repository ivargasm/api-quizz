<?php

    require_once "conection.php";

    class PartialsModel{

        static public function getPartials($data_user, $data_topic, $data_degree){
            $sql = "
                select DISTINCT partial as value, partial as label from questions
                where degree_id = :data_degree
                and topic_id = :data_topic
                and partner_id = :data_user
                order by partial
            ";

            $stmt = Conexion::conectar()->prepare($sql);
            $stmt -> bindParam(":data_user", $data_user, PDO::PARAM_STR);
            $stmt -> bindParam(":data_topic", $data_topic, PDO::PARAM_STR);
            $stmt -> bindParam(":data_degree", $data_degree, PDO::PARAM_STR);
            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);

            $stmt -> close();
            $stmt = null;
        }
    }

?>