<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;

class WebController extends Controller
{
    static public function getBooks()
    {
        $books = Book::all();
        $result = [];
		foreach ($books as $book) {
            $result[$book->id]['title'] = $book->title;
            $result[$book->id]['cover'] = empty($book->cover) || $book->cover == "none" ? asset('storage/images/no-image.png') : $book->cover;
            $result[$book->id]['author'] = isset($book->author->name) ? $book->author->name : 'anonymous';
        }
        return $result;
    }

    static public function getAuthors()
    {
        $authors = Author::all();
        $result = [];
		foreach ($authors as $author) {
            $result[$author['id']]['name'] = $author['name'];
            $result[$author['id']]['count'] = count($author->books);
        }
        return $result;
    }
}
