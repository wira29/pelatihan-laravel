<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            // disini mengambil data dari DB, dengan nama terserah 
            'categories' => Category::all()
        ];
        return view('dashboard.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:categories,nama',
            'deskripsi' => 'required|min:15'
        ], [
            'nama.required' => 'Nama kategori wajib diisi',
            'nama.unique' => 'Nama kategori sudah ada',
            'deskripsi.required' => 'Deskripsi kategori wajib diisi',
            'deskripsi.min' => 'Deskripsi kategori minimal 15 karakter'
        ]);

        //    perintah tambah data 
        Category::query()->create($request->all());

        // kembali ke halaman index 
        return redirect()->route('kategori.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        return view('kategori.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'category' => Category::findOrFail($id)
        ];
        return view('dashboard.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, String $id)
    {
        // dd($request->all());
        $data = $request->validated();
        $category = Category::findOrFail($id);
        $category->update($data);
        // dd($category);
        return redirect()->route('kategori.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('kategori.index')->with('success', 'Data berhasil dihapus');
    }
}
