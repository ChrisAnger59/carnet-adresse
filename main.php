<?php

declare(strict_types=1);

require_once('Command.php');
$commande = new Command();


while (true) {

    $line = readline("Entrez votre commande (list, detail, create, delete, help, quit) : ");

    /***  COMMANDE SAISIE "LIST" *******/
    if ($line === "list") {

        echo "\nListe des contacts :\n\n";
        echo "id, name, email, phone number\n\n";
        $commande->list();

    /***  COMMANDE SAISIE "DETAIL" *******/
    } elseif (preg_match("/\bdetail\b/", $line)) {
        $id = (int) preg_replace('/\D/', '', $line);

        try {
            $commande->detail($id);
        } catch (InvalidArgumentException $erreur) {
            echo "Erreur: " . $erreur->getMessage();
        }
        
    /***  COMMANDE SAISIE "CREATE" *******/
    } elseif (preg_match("/\bcreate\b/", $line)) {

        $infos = (string) preg_replace('/^create\s+/i', '', $line);

        try {
            $commande->create($infos);
            echo "Nouveau contact créé !\n";
        } catch (InvalidArgumentException $erreur) {
            echo "Erreur: " . $erreur->getMessage();
        } catch (Exception $erreur_global) {
            echo "Erreur Global\n";
        }
        
    /***  COMMANDE SAISIE "DELETE" *******/
    } elseif (preg_match("/\bdelete\b/", $line)) {

        $id = (int) preg_replace('/\D/', '', $line);

        try {
            $commande->delete($id);
            echo "Contact supprimé\n";
        } catch (InvalidArgumentException $erreur) {
            echo $erreur->getMessage() . "\n";
        } catch (PDOException $erreur_pdo) {
            echo "Erreur connexion BDD\n";
        } catch(Exception $erreur_global) {
            echo "Erreur Global\n";
        }

    /***  COMMANDE SAISIE "HELP" *******/
    } elseif ($line === "help") {

        echo "\nhelp : affiche cette aide\n\n";
        echo "list : liste les contacts\n\n";
        echo "create [name], [email], [phone number] : créer un nouveau contact\n\n";
        echo "delete [id] : supprime un contact\n\n";
        echo "quit : quitte le programme\n\n\n";
        echo "Attention à la syntaxe des commandes, les espaces et les virgules sont important\n";
        echo "(Il n'est pas necessaire de mettre les '[ ]')\n\n\n";

    /***  COMMANDE SAISIE "QUIT" *******/
    } elseif ($line === "quit") {

        exit(0);

    } else {
            echo "Erreur: la commande saisie: '{$line}' n'existe pas\n";
    }
}