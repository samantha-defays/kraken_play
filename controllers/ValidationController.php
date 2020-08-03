<?php


class Validation
{

    public static function CreateView()
    {

        //saving order
        if (($_SESSION['logged'] == true) && (!empty($_SESSION['shoppingCart']))) {
            $userID = $_SESSION['user']['id'];
            $total = $_SESSION['totalCart'];

            $order = new OrderModel();
            $order->saveOrder($userID, $total);

            $_SESSION['shoppingCart'] = [];
            $_SESSION['totalCart'] = 0;

            $test = "";
            $variables = compact('test');

            Utils::render('Validation', $variables);
        } else {
            header('Location: ./login');
        }
    }
}
