<?php

class Logout
{

    public static function loggingOut()
    {
        //destroying ongoing session, effectively logging the user out
        session_destroy();
        header('Location: ./');
        exit();
    }
}
