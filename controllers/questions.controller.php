<?php

    class QuestionsController{

        public function index($data){
            $data_questions=array(            
                "degree"=>urldecode($data[3]),
                "topic"=>urldecode($data[4])
            );

            if (isset($data[5]) && !empty($data[5])) {
                $data_questions["partial"] = $data[5];
            }

            // extraer los datos del modelo y enviarlos a la vista
            $quizz = QuestionsModel::getQuestions($data_questions);
            $json=array(            
                "questions"=>$quizz
            );

            foreach ($quizz as $key => $value) {
                $answersArray = explode('|', $value['answers']);
                $value['answers'] = $answersArray;
                $quizz[$key] = $value;
            }

            // Si deseas convertir todo el resultado a formato JSON:
            echo json_encode($quizz);
            return;
        }

    }

?>