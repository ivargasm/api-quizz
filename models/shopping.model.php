<?php

    require_once "conection.php";

    class ShoppingModel{

        static public function getProducts(){

            $sql = "
            SELECT
                p.product_id AS id,
                p.name,
                p.description,
                p.price,
                ct.name category,
                g.name gender,
                p.image_url AS imageUrl,
                p.image_name AS imageName,
                GROUP_CONCAT(DISTINCT c.name) AS colors,
                GROUP_CONCAT(DISTINCT s.name) AS sizes
            FROM products p
            JOIN product_colors pc ON p.product_id = pc.product_id
            JOIN colors c ON pc.color_id = c.color_id
            JOIN product_sizes ps ON p.product_id = ps.product_id
            JOIN sizes s ON ps.size_id = s.size_id
            join category ct on ct.category_id = p.category_id
            join genders g on g.gender_id = p.gender_id
            WHERE p.active = true
            GROUP BY p.product_id, p.name, p.description, p.price, p.image_url, p.image_name;
        ";

            $stmt = Conexion::conectar()->prepare($sql);
            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);

            $stmt -> close();
            $stmt = null;

        }

    }

?>