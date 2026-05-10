<?php

while(true){
    $commande = "list";
    $line = readline("Entrez votre commande: ");
    if($line === $commande)
        {
            echo "affichage de la liste\n";
        }else{
            echo "mauvaise commande saisie: {$line}\n";
        }
}