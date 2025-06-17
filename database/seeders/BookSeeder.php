<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $photo = UploadedFile::fake()->image('sherlock.jpg');

        $originalFilename = $photo->getClientOriginalName();
        $fileName = pathinfo($originalFilename, PATHINFO_FILENAME);
        $fileName = $fileName . '_' . Str::random(10) . '_' . now()->format('Y-m-d-H:i:s') . '.' . $photo->extension();
        $path = Storage::disk('public')->putFileAs('photos', $photo, $fileName);

        Book::create([
            'title' => "Sherlock Holms",
            'author' => "Artur Conan Doyle",
            'description' => "Description",
            'cover_image' => $path,
            'available_copies' => 12,
        ]);

        $photo = UploadedFile::fake()->image('Tolstoy.jpg');

        $originalFilename = $photo->getClientOriginalName();
        $fileName = pathinfo($originalFilename, PATHINFO_FILENAME);
        $fileName = $fileName . '_' . Str::random(10) . '_' . now()->format('Y-m-d-H:i:s') . '.' . $photo->extension();
        $path = Storage::disk('public')->putFileAs('photos', $photo, $fileName);

        Book::create([
            'title' => "War and peace",
            'author' => "Lev Tolstoy",
            'description' => "Description",
            'cover_image' => $path,
            'available_copies' => 12,
        ]);
    }
}
