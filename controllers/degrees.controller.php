<?php

    class DegreesController{

        public function index(){
            print_r("entre a degrees controller");

            // extraer los datos del modelo y enviarlos a la vista
            $degrees = DegreesModel::getDegrees();
            $json=array(            
                "degrees"=>$degrees
            );

            // Si deseas convertir todo el resultado a formato JSON:
            echo json_encode($degrees);
            return;
        }

    }

?>