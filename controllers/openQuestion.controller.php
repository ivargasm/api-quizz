<?php

require $rootDirectory . 'vendor/autoload.php';  // Asegúrate de incluir el autoload de Composer al inicio de tu script

// Carga las variables de entorno desde .env
$dotenv = Dotenv\Dotenv::createImmutable($rootDirectory);
$dotenv->load();

    class OpenQuestionController{

        public function index($question, $userAnswer){

            $apiKey = $_ENV['OPENAI'];
            $endpoint = 'https://api.openai.com/v1/chat/completions';

            $data = array(
                'model' => 'gpt-3.5-turbo',
                'messages' => array(
                    array("role" => "system", "content" => "Tu eres un asistente experto en analizar si la respuesta a una pregunta es o no correcta, la pregunta esta enserrada en las etiquetas <question></question> y la respuesta en las etiquetas <response></response>"),
                    array("role" => "user", "content" => "<question>¿Cuanto es 2 + 4?</question>: <response>6</response>"),
                    array("role" => "assistant", "content" => "correcto"),
                    array("role" => "user", "content" => "<question>".$question."</question>: <response>".$userAnswer."</response>")
                )
            );

            $dataString = json_encode($data);

            $ch = curl_init($endpoint);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $apiKey
            ));

            $response = curl_exec($ch);
            curl_close($ch);

            $responseData = json_decode($response, true);

            // echo $responseData['choices'][0]['message']['content'];

            // Si deseas convertir todo el resultado a formato JSON con un status 200:
            echo json_encode($responseData['choices'][0]['message']['content']);
            return;
        }

    }

?>