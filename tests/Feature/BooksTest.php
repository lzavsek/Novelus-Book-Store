<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BooksTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function guests_may_not_create_a_book()
    {
        $this->post('/books')->assertRedirect('/login');
    }
    
    /** @test */
    public function an_admin_can_create_a_book()
    {
        $this->withoutExceptionHandling();
        
        // Given I am logged in as an admin
        $this->actingAs(factory('App\User')->create());
        
        // When they hit an endpoint /books, while passing the necessary data
        $attributes = [
            'title' => 'Robinson Crusoe',
            'author' => 'Daniel Defoe',
            'year' => 1719,
            'quantity' => 10
        ];
        $this->post('/books', $attributes);
        
        // Then there should be a new book in the database
        $this->assertDatabaseHas('books', $attributes);
    }
    
}
