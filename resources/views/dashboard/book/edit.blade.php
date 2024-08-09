@extends('dashboard.layout')

@section('konten')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Halaman Edit Buku</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Blank Page</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
    <section class="content">
      @if($errors->any())
        <div class="row p-2">
          <div class="alert alert-danger col-12">
            <ul>
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
        @endif`
        <div class="card">  
            <div class="card-body">
                <form action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                  @method('PATCH')
                  @csrf
                      <div class="form-group">
                        <label for="category">Kategori</label>
                        <select name="category_id" id="category" class="form-control" placeholder="Pilih kategori">
                            @foreach($categories as $category)
                                <option {{ $book->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input name="nama" type="text" value="{{ $book->nama }}" class="form-control" id="nama" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" placeholder="masukkan deskripsi" class="form-control" id="deskripsi" rows="3">{{ $book->deskripsi }}</textarea>
                    </div>
                    <div class="form-group">
                      <label for="gambar">Gambar</label>
                      <input name="gambar" type="file" class="form-control" id="gambar" placeholder="Masukkan nama kategori">
                  </div>
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary mr-3">Simpan</button>
                        <a href="{{ route('book.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection