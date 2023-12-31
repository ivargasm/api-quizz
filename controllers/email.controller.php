<?php

require $rootDirectory . 'vendor/autoload.php';  // Asegúrate de incluir el autoload de Composer al inicio de tu script

// Carga las variables de entorno desde .env
$dotenv = Dotenv\Dotenv::createImmutable($rootDirectory);
$dotenv->load();

class CorreoController {

    public function enviarCorreo($datos) {
        // Verifica que la solicitud sea de tipo POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405); // Método no permitido
            echo json_encode(['error' => 'Método no permitido']);
            return;
        }

        // Verifica que se reciban datos en formato JSON
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400); // Solicitud incorrecta
            echo json_encode(['error' => 'Formato JSON no válido']);
            return;
        }

        // Recupera los datos del formulario y del carrito
        $nombreCliente = $input['firstName'] . ' ' . $input['lastName'];
        $correoCliente = $input['email'];
        $telefonoCliente = $input['phone'];
        $direccionCliente = $input['streetAddress'] . ', ' . $input['city'] . ', ' . $input['region'] . ', ' . $input['postalCode'];

        // Puedes agregar más lógica según tus necesidades

        // Lógica para enviar el correo
        $asunto = 'Consulta sobre productos';
        $mensaje = "Hola Estampalicios,\n\n";
        $mensaje .= "Tienes un mensaje de: $nombreCliente\n";
        $mensaje .= "Que le gustaría más información sobre los siguientes productos:\n";

        foreach ($input['cart'] as $producto) {
            $mensaje .= "- Producto: {$producto['product']}, Color: {$producto['color']}, Talla: {$producto['size']}, Cantidad: {$producto['quantity']}\n";
        }

        // Lógica para enviar el correo
        $resend = Resend::client($_ENV['RESEND']);

        $resend->emails->send([
            'from' => 'Acme <onboarding@resend.dev>',
            'to' => ['ivargasm@hotmail.com'],
            'subject' => 'Shopping Cart',
            'text' => $mensaje,
            'headers' => [
                'X-Entity-Ref-ID' => '123456789',
            ],
            'tags' => [
                [
                'name' => 'estampalicious',
                'value' => 'confirm_email',
                ],
            ],
        ]);
    }

}

?>
