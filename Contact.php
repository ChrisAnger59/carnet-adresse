<?php

class Contact
{
    private ?int $id;
    private ?string $name;
    private ?string $email;
    private ?string $phone_number;

    // Valide et initialise les données de l'instance contact à sa création
    public function __construct(?int $id, string $name, string $email, string $phone_number)
    {
        // Si aucun nom, Lève une Exception et stoppe la création de l'objet Contact
        if(empty($name)){

            throw new InvalidArgumentException("Nom vide\n");

        // Si aucun email ou s'il n'est pas valide 
        // Lève une Exception et stoppe la création de l'objet Contact
        }elseif(empty($email) || !self::isValidEmail($email)){

            throw new InvalidArgumentException("email vide ou invalide\n");

        // Si aucun téléphone ou s'il n'est pas valide
        // Lève une Exception et stoppe la création de l'objet Contact
        }elseif(empty($phone_number) || !self::isValidNumber($phone_number)){

            throw new InvalidArgumentException("Téléphone vide ou invalide\n");

        }

        // Assigne des valeurs aux propriétés
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

    // Formate le contact instancié en une ligne lisible pour l'affichage
    public function toString(): string
    {
        return $this->getId() . ", " . $this->getName() . ", " . $this->getEmail() . ", " . $this->getPhoneNumber() . "\n\n"; 
    }

    // Méthode static : validation d'une valeur brute (variable) indépendante de l'objet
    public static function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    // Méthode static : validation d'une valeur brute (variable) indépendante de l'objet
    public static function isValidNumber(string $phone_number): bool
    {
        return preg_match('/^[0-9]{10}$/', $phone_number) === 1;
    }
}