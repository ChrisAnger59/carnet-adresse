<?php

declare(strict_types=1);

class DBConnect
{
    public function getPDO(): PDO
    {
        // Ajouter la gestion des exceptions pour la connexion à la base de données avec Try/Catch
        try {
            $pdo = new PDO(
            'mysql:host=localhost;dbname=carnet_adresses;charset=utf8mb4',
            'root',
            '',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );

        return $pdo;

        } catch (PDOException $erreur_pdo) {
            echo $erreur_pdo->getMessage();
            die("Une erreure est survenue");
        }

    }
}