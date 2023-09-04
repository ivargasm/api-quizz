<?php

    class TopicsController{

        public function index($data){

            // $degrees = DegreesModel::getDegrees();

            // foreach ($degrees as $key => $value) {
            //     if (strtoupper($value['label']) == strtoupper($data[3])) {
            //         $degree_id = $value['value'];
            //     }
            // }

            // $data_topics=array(            
            //     "degree"=>urldecode($degree_id)
            // );

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