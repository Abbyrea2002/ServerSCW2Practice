<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Arr;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_returns_books_list(): void
    {
        $user = User::factory()->create();
        $book = Book::create([
            'title' => "Harry Potter",
            'author' => "JK Rolling",
            'description' => "Magical World",
            'published_year' => "1998",
        ]);

        $response = $this->actingAs($user)->getJson(route('books.index'));

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJson([
                'data' => [Arr::only($book->toArray(), ['id', 'title'])]
            ]);
    }

    
    public function test_api_book_update_successful()
    {
        $user = User::factory()->create();
        $book = Book::create([
            'title' => "Harry Potter",
            'author' => "JK Rolling",
            'description' => "Magical World",
            'published_year' => "1998",
        ]);
        $bookChanges = ['id' => 1, 'title' => 'Jungle Book', 'description' => 'Childrens story about animals', 'author' => 'Kipling', 'published_year' => '1894',];

        $response = $this->actingAs($user)->putJson(route('books.update', $book), $bookChanges);

        $response->assertStatus(200)
            ->assertJsonFragment([
                        "id" => 1,
                        "title" => "Jungle Book",
                        "author" => "Kipling",
                        "description" => "Childrens story about animals",
                        "published_year" => "1894",
            ]
            );
    }


}

