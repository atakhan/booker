@extends('layouts.app')
@section('content')
<h1>Admin page</h1>
<hr>
    <div class="flex flex-row">
        <div class="p8 wfull">
            <div class="flex align-items-center">
                <h2 class="pr16">Authors</h2>
                <button class="btn bg-violet text-white" id="addAuthorBtn">&plus; add</button>
            </div>
            @foreach ($data as $author => $books)
            <p>
                <b>{{ $author }}</b> 
                ({{ count($books) }} 
                <i>{{ count($books) > 1 ? 'books' : 'book' }})</i>

            </p>
            @endforeach
        </div>
        
        <div class="p8 wfull">
            <h2>Books</h2>
            @foreach ($data as $author => $books)
                @foreach ($books as $book)
                    <p>{{ $book }} - <i>{{ $author }}</i></p>
                @endforeach
            @endforeach
        </div>
    </div>
    {{-- Modal --}}
    <div id="addAuthorModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <section class="align-items-center flex flex-column">
                <h1>Add author</h1>
                <input type="text" name="name" class="p16 large-font w300" autocomplete="off">
                <p id="modal_responseMessage">write new author name</p>
                <a href="#" class="btn bg-violet text-white">Add</a>
            </section>
        </div>
    </div>
@endsection

