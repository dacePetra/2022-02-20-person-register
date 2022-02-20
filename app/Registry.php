<?php

namespace App;

class Registry extends DBConnect
{
    protected function setPerson($name, $surname, $personalCode)
    {
        $entry = [
            'name' => $name,
            'surname' => $surname,
            'personalcode' => $personalCode
        ];
        try {
            $this->connect()->insert('register', $entry);
        } catch (\Doctrine\DBAL\Exception $e) {
            echo 'Error! ' . $e->getMessage() . PHP_EOL;
            die();
        }
    }

    protected function checkPersonExists($personalCode): bool
    {
        $status = '';
        foreach ($this->connect()->iterateAssociativeIndexed(
            'SELECT id, name, surname, personalcode FROM register') as $id => $entry) {
            if ($personalCode == $entry['personalcode']) {
                $status = false;break;
            } else {
                $status = true;
            }
        }
        return $status;
    }
}