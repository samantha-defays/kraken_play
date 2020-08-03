<?php

class AdminUsers
{
    public static function CreateView()
    {
        $model = new UserModel;
        $users = $model->getUserList();

        $variables = compact('users');

        Utils::render('AdminUsers', $variables);
    }
}
