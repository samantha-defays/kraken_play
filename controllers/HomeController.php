<?php


class Home
{

    public static function CreateView()
    {

        $null = "";
        $variables = compact('null');

        Utils::render('Home', $variables);
    }
}
