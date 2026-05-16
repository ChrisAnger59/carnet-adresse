<?php

declare(strict_types=1);

class ContactService
{
    public static function isValidName(string $name): bool
    {
        return !empty(trim($name));
    }

    public static function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false && !empty(trim($email));
    }

    public static function isValidNumber(string $phone_number): bool
    {
        return preg_match('/^[0-9]{10}$/', $phone_number) === 1 && !empty(trim($phone_number));
    }

    // Formate le contact instancié en une ligne lisible pour l'affichage
    public static function ligneTexte(Contact $contact): string
    {
        return $contact->getId() . ", " . $contact->getName() . ", " . $contact->getEmail() . ", " . $contact->getPhoneNumber() . "\n\n"; 
    }
}