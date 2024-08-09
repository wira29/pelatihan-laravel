<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'books' => Book::query()->with('category')->get(),
        ];
        return view('dashboard.book.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'categories' => Category::query()->get(),
        ];
        return view('dashboard.book.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBookRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('buku');
        }

        Book::query()->create($data);

        return redirect()->route('book.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'book' => Book::query()->findOrFail($id),
            'categories' => Category::query()->get(),
        ];
        return view('dashboard.book.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateBookRequest $request, string $id)
    {
        $data = $request->validated();
        $buku = Book::query()->findOrFail($id);

        if ($request->hasFile('gambar')) {
            if ($buku->gambar) {
                if (Storage::exists($buku->gambar)) {
                    Storage::delete($buku->gambar);
                }
            }

            $data['gambar'] = $request->file('gambar')->store('buku');
        } else {
            $data['gambar'] = $buku->gambar;
        }

        $buku->update($data);

        return redirect()->route('book.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Book::findOrFail($id);

        if ($buku->gambar) {
            if (Storage::exists($buku->gambar)) {
                Storage::delete($buku->gambar);
            }
        }

        $buku->delete();

        return redirect()->route('book.index')->with('success', 'Data berhasil dihapus');
    }
}
