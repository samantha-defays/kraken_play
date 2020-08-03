<?php

class UserModel
{

    // sending info to the database
    public function saveCustomerInfo(
        $lastname,
        $firstname,
        $birthdate,
        $address,
        $city,
        $postcode,
        $country,
        $email,
        $password
    ) {
        $pdo = DatabaseModel::getConnection();

        $sql = "INSERT INTO `users` VALUES(
            NULL, 
            :firstname, 
            :lastname, 
            :birthdate, 
            :customerAddress, 
            :city, :postcode, 
            :country,  
            :email, 
            :customerPassword,
            'Customer'
            )";
        // hashing the password
        $hash = password_hash($password, PASSWORD_BCRYPT);

        $query = $pdo->prepare($sql);
        $query->execute([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'birthdate' => $birthdate,
            'customerAddress' => $address,
            'city' => $city,
            'postcode' => $postcode,
            'country' => $country,
            'email' => $email,
            'customerPassword' => $hash
        ]);
    }

    // checking if the e-mail has already been registered
    public function checkEmailAvailability($email)
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "SELECT email FROM `users` WHERE email = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$email]);
        $DBemail = $query->fetch();
    }

    public function allowUserLogin($email, $password)
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "SELECT * FROM `users` WHERE email = ?";

        $query = $pdo->prepare($sql);
        $query->execute([$email]);

        $user = $query->fetch();

        if ($user == null)
            return null;

        $hash = $user['password'];

        if (password_verify($password, $hash) == true) {
            return $user;
        } else {
            return null;
        }
    }

    // getting the list of all users
    public function getUserList()
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "SELECT * from `users`";
        $query = $pdo->query($sql);
        return $query->fetchAll();
    }

    // counting the number of members stored in DB
    public function countTotalUsers()
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "SELECT COUNT(*) as `total` FROM `users`";
        $query = $pdo->query($sql);
        return $query->fetch();
    }
}
