<?php

declare(strict_types=1);

class DBConnect
{
    public function getPDO(): PDO
    {
            $pdo = new PDO(
                'mysql:host=localhost;dbname=carnet_adresses;charset=utf8mb4',
                'root',
                '',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]
            );

            return $pdo;
    }
}