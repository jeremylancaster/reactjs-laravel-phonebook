<?php

use App\Phonebooks;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PhonebooksTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function it_fetches_all_phonebook_entries()
    {
        // Given
        // Write the model factory
        factory(Phonebooks::class, 3)->create();

        // When
        $phonebookEntries = Phonebooks::get();

        // Then
        $this->assertNotNull($phonebookEntries[0]->name);
    }

    /** @test */
    function can_insert_phone_entry_into_database()
    {
        $spec = new Phonebooks;
        $spec->name = "Test User";
        $spec->phone_number = '724-555-1212';
        $spec->address1 = '555 Easy St';
        $spec->city = 'Test City';
        $spec->state = 'NC';
        $spec->zip_code = '55555';
        $spec->save();
    }
}