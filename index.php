<?php

spl_autoload_register(function ($class_name) {
    if (file_exists('./classes/' . $class_name . '.php')) {
        require_once './classes/' . $class_name . '.php';
    }
    if (file_exists('./Controllers/' . $class_name . 'Controller.php')) {
        require_once './Controllers/' . $class_name . 'Controller.php';
    }
    if (file_exists('./models/' . $class_name . '.php')) {
        require_once './models/' . $class_name . '.php';
    }
});

session_start();

require_once('Routes.php');
