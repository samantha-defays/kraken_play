<?php

class OrderModel
{
    // getting the list of all orders by dice
    public function getOrderList()
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "SELECT orders.date, orders.id, orders.totalPrice, products.name, products.price, users.firstName, users.lastName, product_order.productQuantity, product_order.totalProduct from orders
        INNER JOIN users
        ON orders.customerNumber = users.id
        INNER JOIN product_order
        ON orders.id = product_order.orderID
        INNER JOIN products
        ON products.id = product_order.productID
        ORDER BY orders.id DESC";
        $query = $pdo->query($sql);
        return $query->fetchAll();
    }

    //getting the total of orders registered in DB
    public function countTotalOrders()
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "SELECT COUNT(*) as `total` FROM `orders`";
        $query = $pdo->query($sql);
        $totalOrders = $query->fetch();

        return $totalOrders;
    }

    //saving an order in DB
    public function saveOrder($userID, $totalCart)
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "INSERT INTO orders VALUES ( NULL , NOW(), :userID, :totalCart ) ";

        $query = $pdo->prepare($sql);
        $query->execute([
            'userID' => $userID,
            'totalCart' => number_format($totalCart, 2)
        ]);

        $sql = " SELECT MAX(id) as id FROM orders";
        $query = $pdo->query($sql);

        $orderID = $query->fetch()['id'];


        foreach ($_SESSION['shoppingCart'] as $cart) {
            $product = $cart['product'];

            $total = $product['price'] * $cart['quantity'];

            $this->saveOrderDetails($cart['quantity'], $orderID, $product['id'], floatval($total));
        }
    }

    private function saveOrderDetails($productQuantity, $orderID, $productID, $productTotal)
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "INSERT INTO product_order VALUES ( :productID , :orderID , :productQuantity, :productTotal ) ";

        $query = $pdo->prepare($sql);
        $query->execute([
            'productID' => $productID,
            'orderID' => $orderID,
            'productQuantity' => $productQuantity,
            'productTotal' => $productTotal
        ]);
    }
}
