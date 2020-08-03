<?php


class Login
{

    public function checkLogin()
    {
        //check if the email & password match with DB
        $loginEmail = $_POST['email'];
        $loginPassword = $_POST['password'];

        if ((!empty($loginEmail)) && (!empty($loginPassword))) {
            $signIn = new UserModel();
            $login = $signIn->allowUserLogin($loginEmail, $loginPassword);


            if ($login == null) {
                $loginError = true;
            } else {
                $loginError = false;
                $_SESSION['user'] = $login;
                $_SESSION['logged'] = true;

                header('Location: ./');
                exit();
            }
        }
        return $loginError;
    }

    public static function CreateView()
    {
        if (!empty($_POST)) {
            $log = new Login();
            $loginError = $log->checkLogin();

            if ($loginError == true) {
                $variables = compact('loginError');
            }
        } else {
            $none = "";
            $variables = compact('none');
        }

        Utils::render('Login', $variables);
    }
}
