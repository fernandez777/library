<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Book;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
    

    use RefreshDatabase;

    /** test */

    public function test_a_book_can_be_added_to_library()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => 'Cool Book Title',
            'author' => 'Victor'
        ]);

        $this->assertCount(1, Book::all());
        $book = Book::first();
        $response->assertRedirect('/books/' . $book->id);
    }

    /** test */

    public  function test_a_title_is_required()
    {
        // $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => '',
            'athor' => 'Victor'
        ]);

        $response->assertSessionHasErrors('title');
    }
     
    /** test */

    public function test_author_is_required()
    {
        $response = $this->post('/books', [
            'title' => 'Cool Title',
            'author' => ''
        ]);

        $response->assertSessionHasErrors('author');
    }

    /** test */

    public function test_book_can_be_updated()
    {
        // $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'Cool Title',
            'author' => 'Victor'
        ]);

        $book = Book::first();

        $response = $this->patch('/books/' . $book->id, [
            'title' => 'New Title',
            'author' => 'New Author'
        ]);

        $this->assertEquals('New Title', Book::first()->title);
        $this->assertEquals('New Author', Book::first()->author);
        $response->assertRedirect('/books/' . $book->id);
    }

    /** test */ 

    public function test_a_book_can_be_deleted()
    {

        $this->withoutExceptionHandling();
        
        $this->post('/books', [
            'title' => 'Cool Title',
            'author' => 'Victor'
        ]);         

        $book = Book::first();

        $this->assertCount(1, Book::all());
        
        $response = $this->delete('/books/' . $book->id);

        $this->assertCount(0, Book::all());

        $response->assertRedirect('/books');
    }


}







































