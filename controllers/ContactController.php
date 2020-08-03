<?php


class Contact
{

    public static function CreateView()
    {
        $test = "";
        $variables = compact('test');

        Utils::render('Contact', $variables);
    }
}
