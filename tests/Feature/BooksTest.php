<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BooksTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function an_admin_can_create_a_book()
    {
        // Given I am logged in as an admin
        $this->actingAs(factory('App\User')->create());
        
        // When they hit an endpoint /books, while passing the necessary data
        $this->post('/books',
        [
            'title' => 'Robinson Crusoe',
            'author' => 'Daniel Defoe',
            'year' => 1719,
            'quantity' => 10
        ]);
        
        // Then there should be a new book in the database
        $this->assertDatabaseHas('books', [
            'title' => 'Robinson Crusoe',
            'author' => 'Daniel Defoe',
            'year' => 1719,
            'quantity' => 10
        ]);
    }
}
