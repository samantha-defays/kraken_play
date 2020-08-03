<?php


class Custom
{

    public function addCustomDiceToCart()
    {
        $colorName = $_POST["color"];

        $model = new ProductModel();
        $id = $model->getCustomDiceId($colorName);
        $id = $id['id'];
        $dice = $model->getProductByID($id);

        $diceToAdd = [
            'product' => $dice,
            'quantity' => 1
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
                $_SESSION['shoppingCart'][$i]['quantity'] += 1;
                $_SESSION['totalInCart'] += 1;

                $found = true;
            }
        }

        //if not, adding product and quantity
        if ($found == false) {
            array_push($_SESSION['shoppingCart'], $diceToAdd);
            $_SESSION['totalInCart'] += 1;
        }

        header('Location: ./custom');
        exit;
    }

    public static function CreateView()
    {

        if (!empty($_POST)) {
            $shopping = new Custom;
            $shopping->addCustomDiceToCart();
        }

        $test = "";
        $variables = compact('test');

        Utils::render('Custom', $variables);
    }
}
