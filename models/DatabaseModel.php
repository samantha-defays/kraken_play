<?php

class DatabaseModel
{

    static $pdo;

    public static function getConnection()
    {
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            self::$pdo = new PDO(
                'mysql:host=localhost;dbname=kraken_play;charset=utf8mb4',
                'root',
                '',
                $options
            );
        } catch (PDOException $e) {
            die("Erreur de base de données, réessayez plus tard.");
        }

        return self::$pdo;
    }
}
