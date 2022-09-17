@extends('layouts.app')
@section('content')
    <h1>Public page</h1>
    <hr>
    <h3>Authors and their books</h3>

    @foreach ($data as $author => $books)
        <p>{{ $author }}: {{ count($books) }}</p>
        @foreach ($books as $book)
        <p> - {{ $book }}</p>
        @endforeach
    @endforeach
    
    <h3>raw data:</h3>
    <pre>
        {{ print_r($data) }}
    </pre>
    
@endsection

