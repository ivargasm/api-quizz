<?php

    class TopicsController{

        public function index($data){

            $data_topics = $data[3];

            // extraer los datos del modelo y enviarlos a la vista
            $topics = TopicsModel::getTopics($data_topics);
            $json=array(
                "topics"=>$topics
            );

            // Si deseas convertir todo el resultado a formato JSON:
            echo json_encode($topics);
            return;
        }

    }

?>