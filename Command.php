<?php

declare(strict_types=1);

require_once('ContactManager.php');

class Command
{

    // On déclare une propriété de type ContactManager
    private ContactManager $manager;

    // A chaque Command on instancie une nouvel instance de ContactManager
    public function __construct()
    {
        $this->manager = new ContactManager();
    }

    // On appel la méthode findAll() de notre instance ContactManager
    // Qui renvois un tableau avec un objet Contact par ligne
    public function list()
    {
        $contacts = $this->manager->findAll();

        // Pour chaques objet Contact on appel la méthode toString()
        // Pour afficher de façon lisible les infos du Contact
        foreach($contacts as $contact){
            echo $contact;
        }
    }

    // On appel la méthode findById() de notre instance ContactManager
    // Qui renvois un objet Contact grace à l'$id renseigné en paramètre
    public function detail(int $id)
    {
        $contact = $this->manager->findById($id);

        // Si aucun objet lève une Exception et stoppe la fonction
        if ($contact === NULL) {
            throw new InvalidArgumentException("L'id renseigné n'existe pas\n");

        // Sinon on affiche de façon lisible les infos de l'objet Contact
        } else {
            echo $contact;
        }
    }

    // On appel la méthode createContact() de notre instance ContactManager
    // Qui ne renvois rien 
    public function create(string $infos_brutes){

        // Scinde la chaîne de caractères à chaque virgules dans un tableau (une partie par ligne)
        $input = explode(',', $infos_brutes);

        // Si le tableau retourné par $input n'est pas composé de 3 lignes
        if (count($input) !== 3) {

            // Lève une Exception et retourne un message
            throw new InvalidArgumentException("Informations saisies invalides\n Saisissez : create nom, email, téléphone\n");

        }

            // Chaque ligne du tableaux est stocké dans une variable
            // En supprimant les espaces en début et fin de chaîne
            $name = trim($input[0]);
            $email = trim($input[1]);
            $phone_number = trim($input[2]);

            // On créer un nouvel objet Contact grace aux variables
            $contact = new Contact(null, $name, $email, $phone_number);

            $this->manager->createContact($contact);
    }

    // On appel la méthode deleteContact() de notre instance ContactManager
    // Qui ne renvois rien
    public function delete(int $id)
    {
        $this->manager->deleteContact($id);
        
    }
}