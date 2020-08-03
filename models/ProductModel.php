<?php

class ProductModel
{

    // getting the whole list of products
    public function getProductList()
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "SELECT * FROM products WHERE `custom` = 0";
        $query = $pdo->query($sql);
        $products = $query->fetchAll();

        return $products;
    }

    // getting the list of the four newest dice
    public function getNewestList()
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "SELECT `name`, `photo`, `id` FROM `products` WHERE `custom` = 0 ORDER BY `id` DESC LIMIT 4 ";
        $query = $pdo->query($sql);
        $newest = $query->fetchAll();

        return $newest;
    }

    // getting the list of all colors available
    public function getColorList()
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "SELECT `color` FROM `products` GROUP BY (color)";
        $query = $pdo->query($sql);
        $colors = $query->fetchAll();

        return $colors;
    }

    // getting the list of dice by color
    public function getDiceByColor($color)
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "SELECT * FROM `products` WHERE `color` = :color AND `custom` = 0";
        $query = $pdo->prepare($sql);
        $query->execute(['color' => $color]);
        $colorProducts = $query->fetchAll();

        return $colorProducts;
    }

    // geting product details by id
    public function getProductByID($id)
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "SELECT * FROM `products` WHERE `id` = :id";
        $query = $pdo->prepare($sql);
        $query->execute(['id' => $id]);
        $productDetail = $query->fetch();

        return $productDetail;
    }

    public function addProduct($name, $description, $color, $price, $image)
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "INSERT INTO products VALUES (NULL, :name, :description, :photo, :price, :color, 0)";
        $query = $pdo->prepare($sql);
        $query->execute([
            'name' => $name,
            'description' => $description,
            'color' => $color,
            'price' => $price,
            'photo' => $image
        ]);
    }

    // deleting a product
    public function deleteProduct($id)
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "DELETE FROM `products` WHERE `id` = :id";
        $query = $pdo->prepare($sql);
        $query->execute(['id' => $id]);
    }

    // editing a product with a new photo
    public function editProductWithImage($name, $description, $color, $price, $image, $id)
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "UPDATE products SET `name` = :name, `description` = :description, `color` = :color, `price` = :price, `photo` = :photo WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->execute([
            'name' => $name,
            'description' => $description,
            'color' => $color,
            'price' => $price,
            'photo' => $image,
            'id' => $id
        ]);
    }

    // editing a product without changin the existing photo
    public function editProductWithoutImage($name, $description, $color, $price, $id)
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "UPDATE products SET `name` = :name, `description` = :description, `color` = :color, `price` = :price WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->execute([
            'name' => $name,
            'description' => $description,
            'color' => $color,
            'price' => $price,
            'id' => $id
        ]);
    }

    // counting the number of dice stored in DB
    public function countTotalDice()
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "SELECT COUNT(*) as `total` FROM `products`";
        $query = $pdo->query($sql);
        $totalNumber = $query->fetch();

        return $totalNumber;
    }

    public function getCustomDiceId($colorName)
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "SELECT `id` FROM `products` WHERE `name` = :name";
        $query = $pdo->prepare($sql);
        $query->execute([
            'name' => $colorName
        ]);

        return $query->fetch();
    }
}
