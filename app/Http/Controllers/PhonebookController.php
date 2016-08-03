<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\PhonebooksRepositoryInterface;
use App\Phonebooks;

class PhonebookController extends Controller
{
    protected $phonebookRepo;

    public function __construct(PhonebooksRepositoryInterface $phonebookRepo) {
        $this->phonebook = $phonebookRepo;
    }

    public function create(Request $request) {
        $name = $request->input('name');
        $phone = $request->input('phone');
        $address1 = $request->input('address1');
        $address2 = $request->input('address2');
        $city = $request->input('city');
        $state = $request->input('state');
        $zip = $request->input('zipcode');

        $this->phonebook->createPhonebookEntry($name, $phone, $address1, $address2, $city, $state, $zip);
    }

    public function getall() {
        return $this->phonebook->getAllPhonebookEntries();
    }

    public function delete(Request $request) {
        $id = $request->input('id');

        $this->phonebook->deletePhonebookEntry($id);
    }

    public function edit(Request $request) {
        $id = $request->input('id');
        $editedName = $request->input('name');
        $editedPhone = $request->input('phone');
        $editedAddress1 = $request->input('address1');
        $editedAddress2 = $request->input('address2');
        $editedCity = $request->input('city');
        $editedState = $request->input('state');
        $editedZip = $request->input('zipcode');

        $this->phonebook->updatePhonebookEntry(
            $id,
            $editedName,
            $editedPhone,
            $editedAddress1,
            $editedAddress2,
            $editedCity,
            $editedState,
            $editedZip
        );
    }
}
