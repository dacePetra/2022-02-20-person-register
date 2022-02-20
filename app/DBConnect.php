<?php

namespace App;

class DBConnect
{
    public function connect()
    {
        try {
            $connectionParams = array(
                'dbname' => 'dbpetra',
                'user' => 'root',
                'password' => '',
                'host' => '127.0.0.1',
                'driver' => 'pdo_mysql',
            );
            $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
            return $conn;
        } catch (\Doctrine\DBAL\Exception $e) {
            print "Error!: " . $e->getMessage();
            die();
        }
    }
}