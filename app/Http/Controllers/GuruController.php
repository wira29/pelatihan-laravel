<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        return dd("hello world!");
    }

    public function create()
    {
        return dd("create!");
    }

    public function store(Request $request)
    {
        return dd($request->all(), $request->nama);
    }

    public function update($id)
    {
        return dd("update " . $id);
    }
}
