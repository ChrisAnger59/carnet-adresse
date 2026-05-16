<?php

declare(strict_types=1);

require_once('ContactService.php');


class Contact
{
    // Valide et initialise les données de l'instance contact à sa création
    public function __construct (
        private ?int $id, 
        private string $name, 
        private string $email, 
        private string $phone_number) 
        
    {
        // Assigne et valide des valeurs aux propriétés
        $this->id = $id;
        $this->setName($name);
        $this->setEmail($email);
        $this->setPhoneNumber($phone_number);
    }

    /********* GETTERS *********/
    public function getId(): int
    {
       return $this->id; 
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }


    /********* SETTERS *********/

    public function setName(string $name): void
    {
        // Si aucun nom, Lève une Exception
        if (!ContactService::isValidName($name)) {

            throw new InvalidArgumentException("Nom vide\n");
        }

        $this->name = $name;
    }

    public function setEmail(string $email): void
    {
        // Si aucun email ou s'il n'est pas valide 
        // Lève une Exception
        if (!ContactService::isValidEmail($email)) {

            throw new InvalidArgumentException("email vide ou invalide\n");
        }

        $this->email = $email;
    }

    public function setPhoneNumber(string $phone_number): void
    {
        // Si aucun téléphone ou s'il n'est pas valide
        // Lève une Exception
        if (!ContactService::isValidNumber($phone_number)) {

            throw new InvalidArgumentException("Téléphone vide ou invalide\n");
        }

        $this->phone_number = $phone_number;
    }

    
    // Formate le contact instancié en une ligne lisible pour l'affichage
    public function __toString(): string
    {
        return ContactService::ligneTexte($this);
    }
}