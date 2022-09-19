<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::All();
        $result = [];
		foreach ($books as $book) {
            $result[$book['id']] = [
                'title' => $book['title'],
                'cover' => $book['cover'],
                'author' => $book->author ? $book->author : 'anonymous'
            ];
        }
        return BookResource::collection($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->headers->set('Accept', 'application/json');
        $data = $request->only(['title', 'cover']);
        $author_name = $request->only(['name']);
        $author = Author::where('name', 'LIKE', $author_name)->get()->first();
        if ($author) {
            $data['author_id'] = $author['id'];           
        } else {
            $created_author = Author::create($author_name);
            $data['author_id'] = $created_author->id;
        }
        // $book = Book::create($data);
        if (Book::create($data)) {
            $result = [
                "status" => "success",
                "message" => "Book successfully added"
            ];
        } else {
            $result = [
                "status" => "error",
                "message" => "Something went wrong"
            ];
        }
        return json_encode($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $data = $request->only(['title', 'cover']);
        $author_name = $request->only(['name']);
        $author = Author::where('name', 'LIKE', $author_name)->get()->first();
        if ($author) {
            $data['author_id'] = $author['id'];           
        } else {
            $created_author = Author::create($author_name);
            $data['author_id'] = $created_author->id;
        }
        if ($book->update($data)) {
            $result = [
                "status" => "success",
                "message" => "Book successfully edited"
            ];
        } else {
            $result = [
                "status" => "error",
                "message" => "Cannot update a book"
            ];
        }
        return json_encode($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if ($book->delete()) {
            $result = [
                "status" => "success",
                "message" => "Book successfully removed"
            ];
        } else {
            $result = [
                "status" => "error",
                "message" => "Cannot delete a Book"
            ];
        }
        return json_encode($result);
    }
}
