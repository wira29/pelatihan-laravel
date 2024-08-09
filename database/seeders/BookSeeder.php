<?php

namespace Database\Seeders;

use App\Models\Book;
use Database\Factories\BukuFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::factory(['category_id' => '1'])->count(5)->create();
        // Book::factory(BukuFactory::class, ['category_id' => '1'])->count(5)->create();
    }
}
