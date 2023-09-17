<?php

    class QuestionsController{

        public function index($data){
            $data_questions=array(            
                "degree"=>urldecode($data[3]),
                "topic"=>urldecode($data[4]),
                "user"=>urldecode($data[5])
            );

            if (isset($data[6]) && !empty($data[6])) {
                $data_questions["partial"] = $data[6];
            }

            // extraer los datos del modelo y enviarlos a la vista
            $quizz = QuestionsModel::getQuestions($data_questions);
            $json=array(            
                "questions"=>$quizz
            );

            foreach ($quizz as $key => $value) {
                $answersArray = explode('|', $value['answers']);
                
                // Aquí reemplazamos cada cadena en el array
                foreach($answersArray as &$answer) {
                    $answer = str_replace("\\n", "\n", $answer);
                }
                $value['answers'] = $answersArray;
                $quizz[$key] = $value;
            }

            // Si deseas convertir todo el resultado a formato JSON:
            echo json_encode($quizz);
            return;
        }

    }

?>