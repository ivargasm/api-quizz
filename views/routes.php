<?php

    $arrayRutas = explode("/", $_SERVER['REQUEST_URI']);

    // print_r(array_filter($arrayRutas));
    // print_r(count(array_filter($arrayRutas)));

    // validar si se envio algo a la url
    if(count(array_filter($arrayRutas)) == 1 || count(array_filter($arrayRutas)) == 0){
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
        } else if(array_filter($arrayRutas)[2] == "users"){
            // validar metodo de entrada get
            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET"){

                $topics = new UsersController();
                $topics -> index($arrayRutas);

                
            }
        } else if(array_filter($arrayRutas)[2] == "shopping"){
            // validar metodo de entrada get
            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET"){

                $products = new ShoppingController();
                $products -> index($arrayRutas);

                
            }
        } else if(array_filter($arrayRutas)[2] == "email"){
            // validar metodo de entrada get
            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){

                $email = new CorreoController();
                $email -> enviarCorreo($arrayRutas);

                
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