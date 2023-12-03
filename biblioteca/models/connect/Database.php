<?php

class Database
{
    public static function getConnection()
    {
        try {
            $pdo = new PDO("mysql:dbname=biblioteca;host=localhost", "root", "");
            return $pdo;
        } catch (PDOException $err) {

        }
    }
}