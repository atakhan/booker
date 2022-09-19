@extends('layouts.app')
@section('content')
<section class="flex justify-content-space-between align-items-center">
    <h1>Dashboard</h1>
    <a href="{{ route('welcome') }}" >go to welcome page</a>
</section>
<hr>
    <div class="flex flex-row">
        <div class="p8 wfull">
            <div class="flex align-items-center">
                <h2 class="pr16">Authors</h2>
                <button class="btn bg-violet text-white pl16 pr16 pt8 pb8" id="addAuthorBtn">&plus; add</button>
            </div>
            @foreach ($data['authors'] as $author_id => $author)
            <div class="flex align-items-center mb4">
                <button class="delete-author-btn btn mr8 p8" data-author-id="{{ $author_id }}">
                    <span class="material-symbols-outlined">
                        delete
                    </span>
                </button>
                <button class="edit-author-btn btn mr16 p8" data-author-name="{{ $author['name'] }}" data-author-id="{{ $author_id }}">
                    <span class="material-symbols-outlined">
                        edit
                    </span>
                </button>
                <b>{{ $author['name'] }}</b> &nbsp;
                ({{ $author['count'] }} &nbsp;
                <i>{{ $author['count'] > 1 ? 'books' : 'book' }})</i>

            </div>
            @endforeach
        </div>
        
        <div class="p8 wfull">
            <div class="flex align-items-center">
                <h2 class="pr16">Books</h2>
                <button class="btn bg-violet text-white pl16 pr16 pt8 pb8" id="addBookBtn">&plus; add</button>
            </div>
            @foreach ($data['books'] as $book_id => $book)
            <div class="flex align-items-center">
                <button class="delete-book-btn btn mr8 p8" data-book-id="{{ $book_id }}">
                    <span class="material-symbols-outlined">
                        delete
                    </span>
                </button>
                <button class="edit-book-btn btn mr16 p8" 
                    data-book-title="{{ $book['title'] }}"
                    data-book-cover="{{ $book['cover'] }}"
                    data-book-author="{{ $book['author'] }}"
                    data-book-id="{{ $book_id }}"
                >
                    <span class="material-symbols-outlined">
                        edit
                    </span>
                </button>
                <p>{{ $book['title'] }} - <i>{{ $book['author'] }}</i></p>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Add author modal --}}
    <div id="addAuthorModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="addAuthorForm" action="/api/v1/authors" method="post" class="align-items-center flex flex-column">
                <h1>Add author</h1>
                <input type="text" name="name" id="addAuthorNameInput" class="p16 mb8 large-font w300" autocomplete="off">
                <p class="mb8" id="addAuthorResponse"></p>
                <button type="submit" class="btn bg-violet text-white pl16 pr16 pt8 pb8">Add</button>
            </form>
        </div>
    </div>

    {{-- Edit author modal --}}
    <div id="editAuthorModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="editAuthorForm" action="/api/v1/authors" method="put" class="align-items-center flex flex-column">
                <h1>Edit author</h1>
                <input type="hidden" id="editAuthorIdInput" value="">
                <input type="text" name="name" id="editAuthorNameInput" class="p16 mb8 large-font w300" autocomplete="off">
                <p class="mb8" id="editAuthorResponse"></p>
                <button type="submit" class="btn bg-violet text-white pl16 pr16 pt8 pb8">edit</button>
            </form>
        </div>
    </div>

    {{-- Add book modal --}}
    <div id="addBookModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="addBookForm" action="/api/v1/books" method="post" class="align-items-center flex flex-column">
                <h1>Add book</h1>
                <input id="addBookTitleInput" type="text" name="title" class="p8 mb4 medium-font w300" autocomplete="off" placeholder="Title of book">
                <input id="addBookAuthorNameInput" type="text" name="name" class="p8 mb4 medium-font w300" autocomplete="off" placeholder="Full name of author">
                <input id="addBookCoverInput" type="text" name="cover" class="p8 mb16 medium-font w300" autocomplete="off" placeholder="link to cover">
                <p class="mb8" id="addBookResponse"></p>
                <button type="submit" class="btn bg-violet text-white pl16 pr16 pt8 pb8">Add</button>
            </form>
        </div>
    </div>

    {{-- Edit book modal --}}
    <div id="editBookModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="editBookForm" action="/api/v1/books" method="put" class="align-items-center flex flex-column">
                <h1>Edit book</h1>
                <input type="hidden" id="editBookIdInput" value="">
                <input id="editBookTitleInput" type="text" name="title" class="p8 mb4 medium-font w300" autocomplete="off" placeholder="Title of book">
                <input id="editBookAuthorNameInput" type="text" name="name" class="p8 mb4 medium-font w300" autocomplete="off" placeholder="Full name of author">
                <input id="editBookCoverInput" type="text" name="cover" class="p8 mb16 medium-font w300" autocomplete="off" placeholder="link to cover">
                <p class="mb8" id="editBookResponse"></p>
                <button type="submit" class="btn bg-violet text-white pl16 pr16 pt8 pb8">Edit</button>
            </form>
        </div>
    </div>
@endsection