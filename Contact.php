<?php

require_once('DBConnect.php');

class ContactManager
{
    public function findAll()
    {
        $pdo = new DBConnect;
        $connexion = $pdo->getPDO();

        $query = "SELECT * FROM `contact`";
        $stmt = $connexion->prepare($query);
        $stmt->execute();
        $liste = $stmt->fetchAll();

        $contacts = [];

        foreach($liste as $row)
        {
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
        $pdo = new DBConnect();
        $connexion = $pdo->getPDO();

        $query = "SELECT * FROM `contact` WHERE `id` = :id";
        $stmt = $connexion->prepare($query);
        $stmt->execute(['id' => $id]);
        $info = $stmt->fetch();

        // Si aucune ligne dans le fetch() -> retourne false
        if(!$info){
            // $info ne retourne donc aucun resultat
            return null;
        }

        $details = new Contact(
            $info['id'],
            $info['name'],
            $info['email'],
            $info['phone_number']
        );

        return $details;
        
    }

    public function createContact(string $name, string $email, string $phone_number)
    {
        $pdo = new DBConnect();
        $connexion = $pdo->getPDO();

        $query = "INSERT INTO `contact`(`name`, `email`, `phone_number`) VALUES (:name, :email, :phone_number);";
        $stmt = $connexion->prepare($query);
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'phone_number' => $phone_number
        ]);
    }

    public function deleteContact(int $id)
    {
        $pdo = new DBConnect();
        $connexion = $pdo->getPDO();

        $query = "DELETE FROM `contact` WHERE `id` = :id";
        $stmt = $connexion->prepare($query);
        $stmt->execute(['id' => $id]);
    }
}

class Contact
{
    private ?int $id;
    private ?string $name;
    private ?string $email;
    private ?string $phone_number;

    public function __construct(?int $id, ?string $name, ?string $email, ?string $phone_number)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone_number = $phone_number;
    }

    public function getId(): ?int
    {
       return $this->id; 
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function toString(): string
    {
        return $this->id . ", " . $this->name . ", " . $this->email . ", " . $this->phone_number . "\n\n"; 
    }
}