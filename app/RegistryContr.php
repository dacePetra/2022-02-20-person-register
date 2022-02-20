<?php

namespace App;

class RegistryContr extends Registry
{
    private string $name;
    private string $surname;
    private string $personalCode;

    public function __construct($name, $surname, $personalCode)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->personalCode = $personalCode;
    }

    public function registerPerson()
    {
        if ($this->emptyInput() == false) {
            header("location: ../index.php?error=emptyinput");
            exit();
        }
        if ($this->invalidName() == false) {
            header("location: ../index.php?error=name");
            exit();
        }

        if ($this->invalidSurname() == false) {
            header("location: ../index.php?error=surname");
            exit();
        }

        if ($this->invalidPersonalCode() == false) {
            header("location: ../index.php?error=personalcodeonlynumbers");
            exit();
        }

        if ($this->personalCodeCheck() == false) {
            header("location: ../index.php?error=personalcodealreadyregistered");
            exit();
        }
        $this->setPerson($this->name, $this->surname, $this->personalCode);

    }

    private function emptyInput(): bool
    {
        if (empty($this->name) || empty($this->surname) || empty($this->personalCode)) {
            return false;
        }
        return true;
    }

    private function invalidName(): bool
    {
        return preg_match('/[a-z\s]/i', $this->name);
    }

    private function invalidSurname(): bool
    {
        return preg_match('/[a-z\s]/i', $this->surname);
    }

    private function invalidPersonalCode(): bool
    {
        return preg_match('/[0-9]/i', $this->personalCode);
    }

    private function personalCodeCheck(): bool
    {
        return $this->checkPersonExists($this->personalCode);
    }
}