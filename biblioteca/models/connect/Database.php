<?php

class Database
{
    public static function getConnection()
    {
        $hostname = "172.17.0.1"; // TODO muda para localhost Teca, coloquei assim por causa do docker
        $db_name = "biblioteca";
        $username = "root";
        $password = "";

        try {
            $pdo = new PDO("mysql:dbname=$db_name;host=$hostname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "durden";
            return $pdo;
        } catch (PDOException $err) {
            echo $err->getMessage();
            return null;
        }
    }
}