<?php

class Cart
{
    public function emptyCart()
    {
        $_SESSION['shoppingCart'] = [];
        $_SESSION['totalCart'] = 0;
        $_SESSION['totalInCart']= 0;

        header('Location: ./shop');
        exit();
    }

    public function getTotal()
    {
        // adding total in cart
        $total = 0;

        if (empty($_SESSION['shoppingCart'])) {
            return 0;
        }

        foreach ($_SESSION['shoppingCart'] as $cart) {
            $total += $cart['product']['price'] * $cart['quantity'];
        }

        // adding taxes
        $VAT = 20;
        $totalVAT = $total * $VAT / 100;
        $totalWithTaxes = $total + $totalVAT;

        $_SESSION['totalCart'] = $totalWithTaxes;

        return ['VAT' => $VAT, 'totalVAT' => $totalVAT, 'totalWithTaxes' => $totalWithTaxes, 'totalWithoutTaxes' => $total];
    }

    public static function CreateView()
    {
        $cart = new Cart();
        $prices = $cart->getTotal();

        $variables = compact('prices');

        Utils::render('Cart', $variables);
    }
}
