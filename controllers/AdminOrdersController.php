<?php

class AdminOrders
{
    public static function CreateView()
    {
        $model = new OrderModel;
        $orders = $model->getOrderList();

        $variables = compact('orders');

        Utils::render('AdminOrders', $variables);
    }
}
