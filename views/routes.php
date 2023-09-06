<?php

    $arrayRutas = explode("https://api-quizz-production.up.railway.app", $_SERVER['REQUEST_URI']);

    echo $arrayRutas;

    // validar si se envio algo a la url
    if(count(array_filter($arrayRutas)) == 1){
        $json=array(            
            "rutas"=>array_filter($arrayRutas),
            "detalle"=>"no encontrado 404"
        );
        echo json_encode($json, true);
        return;
    }
    // cuando se envia algo a la url
    else{
        // validar dto enviado
        if(array_filter($arrayRutas)[2] == "questions"){
            // validar metodo de entrada get
            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET"){

                $questions = new QuestionsController();
                $questions -> index($arrayRutas);

                
            }
        } else if(array_filter($arrayRutas)[2] == "degrees"){
            // validar metodo de entrada get
            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET"){

                $degrees = new DegreesController();
                $degrees -> index($arrayRutas);

                
            }
        } else if(array_filter($arrayRutas)[2] == "topics"){
            // validar metodo de entrada get
            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET"){

                $topics = new TopicsController();
                $topics -> index($arrayRutas);

                
            }
        }
        else{
            $json=array(            
                "rutas"=>array_filter($arrayRutas),
                "detalle"=>"no encontrado 404"
            );
            echo json_encode($json, true);
            return;
        }
    }

?>