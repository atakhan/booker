<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\AuthorResource;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();
        $result = [];
		foreach ($authors as $author) {
            $result[$author->id] = $author;
            foreach ($author->books as $book) {
                $result[$author->id]['books'][] = $book;
            }
        }
        return AuthorResource::collection($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $author_name = $request->only(['name']);
        $isset = Author::where('name', 'LIKE', $author_name)->get()->first();
        $result = [];
        if (!$isset) {
            Author::create($author_name);
            $result = [
                "status" => "success",
                "message" => "Author successfully added"
            ];
        } else {
            $result = [
                "status" => "error",
                "message" => "Author is already isset"
            ];
        }
        return json_encode($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        if ($author->update($request->only(['name']))) {
            $result = [
                "status" => "success",
                "message" => "Author successfully updated"
            ];
        } else {
            $result = [
                "status" => "error",
                "message" => "Cannot update an author"
            ];
        }
        return json_encode($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        if ($author->delete()) {
            $result = [
                "status" => "success",
                "message" => "Author successfully removed"
            ];
        } else {
            $result = [
                "status" => "error",
                "message" => "Cannot delete an author"
            ];
        }
        return json_encode($result);
    }
}
