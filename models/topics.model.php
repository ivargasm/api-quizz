<?php

    require_once "conection.php";

    class TopicsModel{

        static public function getTopics($data_topics){

            $sql = "SELECT id as 'value', description as 'label' FROM topics WHERE degree_id = :degree order by id desc";

            $stmt = Conexion::conectar()->prepare($sql);
            $stmt -> bindParam(":degree", $data_topics, PDO::PARAM_STR);
            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);

            $stmt -> close();
            $stmt = null;

        }

    }

?>