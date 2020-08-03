<?php


class Admin
{

    public static function CreateView()
    {
        $model = new ProductModel();
        $totalNumber = $model->countTotalDice();

        $user = new UserModel();
        $totalUsers = $user->countTotalUsers();

        $orders = new OrderModel();
        $totalOrders = $orders->countTotalOrders();

        $events = new EventModel();
        $totalEvents = $events->countTotalEvents();

        $variables = compact('totalNumber', 'totalUsers', 'totalOrders', 'totalEvents');

        Utils::render('Admin', $variables);
    }
}
