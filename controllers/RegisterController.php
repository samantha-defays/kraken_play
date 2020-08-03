<?php


class Register
{

    // checking if the form is complete
    public function checkFormConformity()
    {

        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $birthdate = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $postcode = $_POST['postcode'];
        $country = $_POST['country'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $errors = [];
        $emailError = false;

        // checking if the e-mail is available
        $registering = new UserModel();
        $DBemail = $registering->checkEmailAvailability($email);


        if (empty($lastname))
            array_push($errors, "Nom de famille");
        if (empty($firstname))
            array_push($errors, "Prénom");
        if($_POST['month'] == 2 && ($_POST['day'] == 31 || $_POST['day'] == 30))
            array_push($errors, "Date de naissance erronnée");
        if (empty($address))
            array_push($errors, "Adresse");
        if (empty($city))
            array_push($errors, "Ville");
        if (empty($postcode))
            array_push($errors, "Code Postal");
        if ((strlen($postcode) != 5))
            array_push($errors, "Le code postal doit contenir 5 chiffres.");
        if (empty($country))
            array_push($errors, "Pays");
        if (empty($email))
            array_push($errors, "Adresse e-mail");
        if ($DBemail == $email)
            $emailError = true;
        if (empty($password))
            array_push($errors, "Mot de Passe");
        if (strlen($password) < 8)
            array_push($errors, "Le mot de passe doit contenir au moins 8 caractères.");
        // if no errors were found, sending info to database
        if ((empty($errors) == true) && ($emailError == false)) {
            $signup = new UserModel();
            $signup->saveCustomerInfo(
                $lastname,
                $firstname,
                $birthdate,
                $address,
                $city,
                $postcode,
                $country,
                $email,
                $password
            );

            header('Location: ./login');
            exit();
        }

        return $errors;
    }

    public static function CreateView()
    {
        // if the form has been submitted, checking conformity
        if (!empty($_POST)) {
            $form = new Register();
            $errors = $form->checkFormConformity();


            if (!empty($errors)) {
                $variables = compact('errors');
            }
        } else {
            $test = '';
            $variables = compact('test');
        }

        Utils::render('Register', $variables);
    }
}
