<?php

    class UsersController{
        public function index($data){

            $data_users = $data[4];
            // extraer datos del modelo y enviarlos a la vista
            $users = UsersModel::getUsers($data_users);

            $json=array(            
                "users"=>$users
            );

            // Si deseas convertir todo el resultado a formato JSON:
            echo json_encode($users);
            return;
        }
    }

?>