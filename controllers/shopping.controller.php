<?php

    class ShoppingController{

        public function index(){

            // extraer los datos del modelo y enviarlos a la vista
            $products = ShoppingModel::getProducts();
            $json=array(
                "products"=>$products
            );

            // reemplazar colors y sizes
            foreach ($products as $key => $value) {
                // Procesar colors
                $colorsArray = explode(',', $value['colors']);
                foreach ($colorsArray as &$color) {
                    $color = str_replace("\\n", "\n", $color);
                }
                $value['colors'] = $colorsArray;
    
                // Procesar sizes
                $sizesArray = explode(',', $value['sizes']);
                foreach ($sizesArray as &$size) {
                    $size = str_replace("\\n", "\n", $size);
                }
                $value['sizes'] = $sizesArray;
    
                // Actualizar el producto original en el array $products
                $products[$key] = $value;
            }

            // Si deseas convertir todo el resultado a formato JSON:
            echo json_encode($products);
            return;
        }

    }

?>