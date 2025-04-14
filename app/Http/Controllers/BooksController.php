<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\BooksResource;
use App\Models\Book;


class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   //returns raw eloquent model data 
        //return Book::all(); 
        //return BooksResource::collection(Book::all());
        //wraps each book with custom logic data from BooksResource

        $books = Book::query()
        ->orderBy('published_year', 'desc')
        ->orderBy('title', 'asc')
        ->get(); 
      return BooksResource::collection($books);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([ 
            'title' => 'required|string|max:255', 
            'author' => 'required|string|max:255', 
            'description' => 'required|string', 
            'published_year' => 'required|integer|min:1000|max:' . date('Y'), 
        ]); 

        return Book::create($request->all()); 

    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //return $book;
        return new BooksResource($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'string|max:255',
            'author' => 'string|max:255',
            'description' => 'string',
            'published_year' => 'integer|min:1000|max:' .date('Y'),
        ]);
        $book->update($request->all());

        //return $book;
        return new BooksResource($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(null, 204);
        //is the same as return response()->noContent();
    }
}
