<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    static public function getAll()
    {
        $authors = Author::all();
        $result = [];
		foreach ($authors as $author) {
            foreach ($author->books as $book) {
                $result[$author->name][] = $book->title;
            }
        }
        return $result;
    }
}
