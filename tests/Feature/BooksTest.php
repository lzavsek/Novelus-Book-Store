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
        //$this->withoutExceptionHandling();
        $this->post('/books')->assertRedirect('/login');
    }
    
    /** @test */
    public function an_admin_can_create_a_book()
    {
        $this->withoutExceptionHandling();
        
        // Given I am logged in as an admin
        $this->actingAs(factory('App\User')->create([
            'is_admin' => true
        ]));
        
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
    
    /** @test */
    public function non_admin_user_may_not_create_a_book()
    {
        $this->withoutExceptionHandling();
        
        try {
            $this->actingAs(factory('App\User')->create());
            
            $attributes = [
                'title' => 'Robinson Crusoe',
                'author' => 'Daniel Defoe',
                'year' => 1719,
                'quantity' => 10
            ];
            
            $this->post('/books', $attributes);
        }
        catch (\Symfony\Component\HttpKernel\Exception\HttpException $e) {
            // assertResponseStatus() won't work because the response object is null
            $this->assertEquals(
                403,
                $e->getStatusCode(),
                sprintf("Expected an HTTP status of %d but got %d.", 403, $e->getStatusCode())
            );
        }
    }
    
    
    /** @test */
    public function guests_can_view_a_list_of_books()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/books');
        $response->assertSuccessful();
		$response->assertViewIs('articles.index');
		$response->assertViewHas('articles');
    }
}
