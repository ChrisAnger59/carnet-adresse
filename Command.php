<?php

require_once('Contact.php');

class Command
{
    public function list()
    {
        $manager = new ContactManager();
        $contacts = $manager->findAll();

        foreach($contacts as $contact){
            echo $contact->toString();
        }
    }

    public function detail(int $id)
    {
        $manager = new ContactManager();
        $contact = $manager->findById($id);

        if($contact === NULL){
            throw new InvalidArgumentException("L'id renseigné n'existe pas");
        }else{
            echo $contact->toString();
        }
    }

    public function create(string $infos_brutes){

        // Scinde la chaîne de caractères à chaque virgules dans un tableau (une partie par ligne)
        $input = explode(',', $infos_brutes);

        // Si le tableau retourné par $input n'est pas composé de 3 lignes
        if(count($input) !== 3){

            // Créer une Exception et retourne un message
            throw new InvalidArgumentException("Informations saisies invalides\n Saisissez : create nom, email, téléphone\n");

        }

            // Chaque ligne du tableaux est stocké dans une variable
            // En supprimant les espaces en début et fin de chaîne
            $name = trim($input[0]);
            $email = trim($input[1]);
            $phone_number = trim($input[2]);

            // Si aucun nom saisie, créer une Exception et retourne un message
            if(empty($name)){

                throw new InvalidArgumentException("Nom vide\n");

            // Si aucun email saisie ou s'il n'est pas valide 
            // Créer une Exception et retourne un message
            }elseif(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){

                throw new InvalidArgumentException("email vide ou invalide\n");

            // Si aucun téléphone saisie, s'il n'est pas composé de chiffre entre 0 et 9 ou s'il ne fait pas 10 caractères
            // Créer une Exception et retourne un message
            }elseif(empty($phone_number) || !preg_match('/^[0-9]{10}$/', $phone_number)){

                throw new InvalidArgumentException("Téléphone vide ou invalide\n");

            }

            $manager = new ContactManager();
            $manager->createContact($name, $email, $phone_number);
    }

    public function delete(int $id)
    {
        $manager = new ContactManager();
        $manager->deleteContact($id);
        
    }
}