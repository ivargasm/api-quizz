<?php

    class PartialsController{
        public function index($data){

            $data_user = $data[5];
            $data_topic = $data[4];
            $data_degree = $data[3];
            // extraer datos del modelo y enviarlos a la vista
            $partials = PartialsModel::getPartials($data_user, $data_topic, $data_degree);

            $json=array(            
                "partials"=>$partials
            );

            // Si deseas convertir todo el resultado a formato JSON:
            echo json_encode($partials);
            return;
        }
    }

?>