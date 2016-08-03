<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;

class AcceptanceTest extends TestCase
{
    /** @test */
    public function Page_Rendered_Header_Properly()
    {
        $this->visit('/')
            ->see('AdGate Media Phonebook');
    }

    /** @test */
    public function React_Properly_Loaded()
    {
        $this->visit('/')
             ->see('Enter the details to be saved')
             ->see('Name')
             ->see('Phone')
             ->see('Add');
    }
}
