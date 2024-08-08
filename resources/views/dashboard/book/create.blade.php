@extends('dashboard.layout')

@section('konten')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Halaman Tambah Buku</h1>
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
        @endif
        <div class="card">
            <div class="card-body">
                <form action="{{ route('book.store') }}" method="POST">
                  @method('POST')
                  @csrf
                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <select name="category_id" id="category" class="form-control" placeholder="Pilih kategori">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input name="nama" type="text" class="form-control" id="nama" placeholder="Masukkan nama kategori">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" placeholder="masukkan deskripsi kategori" class="form-control" id="deskripsi" rows="3"></textarea>
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