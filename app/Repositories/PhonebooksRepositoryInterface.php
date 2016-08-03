<?php

namespace App\Repositories;

interface PhonebooksRepositoryInterface {
    public function getAllPhonebookEntries();
    public function createPhonebookEntry($name, $phone, $address1, $address2, $city, $state, $zip);
    public function updatePhonebookEntry($id, $name, $phone, $address1, $address2, $city, $state, $zip);
    public function deletePhonebookEntry($id);
}