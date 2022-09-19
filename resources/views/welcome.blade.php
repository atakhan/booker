@extends('layouts.app')
@section('content')
    <section class="flex justify-content-space-between align-items-center">
        <h1>Booker</h1>
        <a href="{{ route('dashboard') }}" >go to dashboard</a>
    </section>
    <hr>
    <h3>Books ({{ count($data) }})</h3>
    
    <div class="flex flex-wrap wfull justify-content-center align-items-end">
        @foreach ($data as $book)
            <section class="flex flex-column flex-basis-200 p8 align-items-center">
                <img src="{{ $book['cover'] }}" class="wfull" alt="">
                <h3 class="np nm pt16">{{ $book['title'] }}</h3>
                <p class="np nm pt4">{{ $book['author'] }}</p>
            </section>                
        @endforeach
    </div>    
@endsection

