<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Author;
use Carbon\Carbon;
use Tests\TestCase;

class AuthorManagementTest extends TestCase
{

    use RefreshDatabase;

    /** test */

    public function test_an_author_can_be_created()
    {
        $this->withoutExceptionHandling();

        $this->post('/authors', [
            'name' => 'Author Name',
            'dob' => '1992/05/07'
    ]); 

        $author =  Author::all();

        $this->assertCount(1, $author);
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);
    }
























}
