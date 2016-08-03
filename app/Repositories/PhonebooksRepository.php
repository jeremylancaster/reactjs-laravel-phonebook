<?php
namespace App\Repositories;

use App\Phonebooks;

class PhonebooksRepository implements PhonebooksRepositoryInterface
{
    public function getAllPhonebookEntries() {
        return Phonebooks::all();
    }

    public function createPhonebookEntry($name, $phone, $address1, $address2, $city, $state, $zip) {
        $spec = new Phonebooks;
        $spec->name = $name;
        $spec->phone_number = $phone;
        $spec->address1 = $address1;
        $spec->address2 = $address2;
        $spec->city = $city;
        $spec->state = $state;
        $spec->zip_code = $zip;
        $spec->save();
    }

    public function updatePhonebookEntry($id, $name, $phone, $address1, $address2, $city, $state, $zip) {
        $spec = Phonebooks::find($id);
        $spec->name = $name;
        $spec->phone_number = $phone;
        $spec->address1 = $address1;
        $spec->address2 = $address2;
        $spec->city = $city;
        $spec->state = $state;
        $spec->zip_code = $zip;
        $spec->save();
    }

    public function deletePhonebookEntry($id) {
        $spec = Phonebooks::find($id);
        $spec->delete();
    }
}