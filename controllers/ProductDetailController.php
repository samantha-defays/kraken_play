<?php


class ProductDetail
{

    // add item to cart
    public function addToCart()
    {

        $id = $_POST['id'];
        $quantity = intval($_POST['quantity']);

        $model = new ProductModel();
        $dice = $model->getProductByID($id);
        $diceToAdd = [
            'product' => $dice,
            'quantity' => $quantity
        ];

        // if cart is empty, initialize empty cart
        if (empty($_SESSION['shoppingCart'])) {
            $_SESSION['shoppingCart'] = [];
        }

        // item already in cart ? no
        $found = false;

        // if product is already in the cart, adding to quantity
        for ($i = 0; $i < count($_SESSION['shoppingCart']); $i++) {
            if ($_SESSION['shoppingCart'][$i]['product']['id'] == $id) {
                $_SESSION['shoppingCart'][$i]['quantity'] += $quantity;
                $_SESSION['totalInCart'] += $quantity;

                $found = true;
            }
        }

        //if not, adding product and quantity
        if ($found == false) {
            array_push($_SESSION['shoppingCart'], $diceToAdd);
            $_SESSION['totalInCart'] += $diceToAdd['quantity'];
        }

        header('Location: ./shop');
        exit;
    }

    public static function CreateView()
    {

        $shopping = new ProductDetail();
        $model = new ProductModel();
        $id = $_GET['id'];
        $product = $model->getProductByID($id);

        if (!empty($_POST)) {
            $shopping->addToCart();
        }

        $variables = compact('product');

        Utils::render('ProductDetail', $variables);
    }
}
