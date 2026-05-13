<?php

require_once('Contact.php');
require_once('DBConnect.php');

class ContactManager
{
    // On déclare une propriété de type PDO
    private PDO $pdo;

    // On initialise l'instance ContactManager en assignant à $pdo 
    // l'objet PDO resultant de la méthode getPDO() de la classe DBConnect
    // (connexion à la BDD)
    public function __construct()
    {
        $db = new DBConnect();
        $this->pdo = $db->getPDO();
    }


    // Récupère tous les contacts en BDD et les retourne sous forme d'objets Contact
    public function findAll()
    {
        $connexion = $this->pdo;

        $query = "SELECT * FROM `contact`";
        $stmt = $connexion->prepare($query);
        $stmt->execute();

        // On assigne le tableau fetchAll() à $liste
        $liste = $stmt->fetchAll();

        // On créer un tableau vide pour y stocker les objets Contact 
        $contacts = [];

        // Pour chaque lignes du tableau $liste
        foreach($liste as $row)
        {
            // On instancie un nouvel objet Contact qu'on stock dans le tableau $contacts
            $contacts[] = new Contact(
                $row['id'],
                $row['name'],
                $row['email'],
                $row['phone_number']
            );
        }

        return $contacts;
    }

    public function findById(int $id)
    {
        $connexion = $this->pdo;

        $query = "SELECT * FROM `contact` WHERE `id` = :id";
        $stmt = $connexion->prepare($query);

        // On execute la requête en remplissant le placeholder par le paramètre de la méthode
        $stmt->execute(['id' => $id]);

        // on stock la ligne du tableau fetch() dans $info
        $info = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si $info retourne false
        if(!$info){
            // Aucun contact trouvé, on retourne null pour le signaler à l'appelant
            return null;
        }

        // On créer un nouvel objet Contact avec les infos stocké dans le tableau $info
        $details = new Contact(
            $info['id'],
            $info['name'],
            $info['email'],
            $info['phone_number']
        );

        return $details;
        
    }

    public function createContact(Contact $contact)
    {
        $connexion = $this->pdo;

        $query = "INSERT INTO `contact`(`name`, `email`, `phone_number`) VALUES (:name, :email, :phone_number);";
        $stmt = $connexion->prepare($query);

        // On récupère les infos de l'objet Contact en paramètre de la méthode
        $stmt->execute([
            'name' => $contact->getName(),
            'email' => $contact->getEmail(),
            'phone_number' => $contact->GetPhoneNumber()
        ]);
    }

    public function deleteContact(int $id)
    {
        $connexion = $this->pdo;

        $query = "DELETE FROM `contact` WHERE `id` = :id";
        $stmt = $connexion->prepare($query);
        $stmt->execute(['id' => $id]);

        // Si aucune ligne n'a été modifiée apreès la requête 
        // Lève une Exception
        if($stmt->rowCount() === 0){
            throw new InvalidArgumentException("Aucun contact trouvé avec cet id\n");
        }
    }
}