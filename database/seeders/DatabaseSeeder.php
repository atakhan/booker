<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('authors')->insert(
            [
                ["name" => "Anton Chekhov",],
                ["name" => "Joseph Conrad",],
                ["name" => "Charles Dickens",],
                ["name" => "Denis Diderot",],
            ]
        );
        DB::table('books')->insert(
            [
                [
                    "author_id" => 1,
                    "cover" => "https://raw.githubusercontent.com/benoitvallon/100-best-books/master/static/images/stories-of-anton-chekhov.jpg",
                    "title" => "Stories"
                ],
                [
                    "author_id" => 2,
                    "cover" => "https://raw.githubusercontent.com/benoitvallon/100-best-books/master/static/images/nostromo.jpg",
                    "title" => "Nostromo"
                ],
                [
                    "author_id" => 3,
                    "cover" => "https://raw.githubusercontent.com/benoitvallon/100-best-books/master/static/images/great-expectations.jpg",
                    "title" => "Great Expectations"
                ],
                [
                    "author_id" => 4,
                    "cover" => "https://raw.githubusercontent.com/benoitvallon/100-best-books/master/static/images/jacques-the-fatalist.jpg",
                    "title" => "Jacques the Fatalist"
                ]
            ]
        );
    }
}
