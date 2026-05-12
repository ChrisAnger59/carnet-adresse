<?php

require_once('Command.php');


while(true){

    $line = readline("Entrez votre commande (list, detail, create, delete, help, quit) : ");
    $commande = new Command();

    if($line === "list"){

        echo "\nListe des contacts :\n\n";
        echo "id, name, email, phone number\n\n";
        $commande->list();

    }elseif(preg_match("/\bdetail\b/", $line)){

        $id = (int) preg_replace('/\D/', '', $line);

        $commande->detail($id);
            
    }elseif(preg_match("/\bcreate\b/", $line)){

        $infos = (string) preg_replace('/^create\s+/i', '', $line);

        try{
            $commande->create($infos);
            echo "Nouveau contact créé !\n";
        }catch(InvalidArgumentException $erreur){
            echo "Erreur: ". $erreur->getMessage();
        }catch(Exception $erreur_global){
            echo "Erreur innattendue\n";
        }
        
    }elseif(preg_match("/\bdelete\b/", $line)){

        $id = (int) preg_replace('/\D/', '', $line);

        $commande->delete($id);
        echo "Contact supprimé\n";

    }elseif($line === "help"){

        echo "\nhelp : affiche cette aide\n\n";
        echo "list : liste les contacts\n\n";
        echo "create [name], [email], [phone number] : créer un nouveau contact\n\n";
        echo "delete [id] : supprime un contact\n\n";
        echo "quit : quitte le programme\n\n\n";
        echo "Attention à la syntaxe des commandes, les espaces et les virgules sont important\n";
        echo "(Il n'est pas necessaire de mettre les '[ ]')\n\n\n";

    }elseif($line === "quit"){

        exit(0);

    }else{
            echo "Erreur: la commande saisie: '{$line}' n'existe pas\n";
    }
}