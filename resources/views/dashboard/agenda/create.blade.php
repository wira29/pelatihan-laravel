@extends('dashboard.layout')

@push('style')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush

@section('konten')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Halaman Tambah Agenda</h1>
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
                <form action="{{ route('agenda.store') }}" method="POST">
                  @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input name="title" type="text" value="{{ old('title') }}" class="form-control" id="nama" placeholder="Masukkan nama kategori">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" placeholder="masukkan deskripsi kategori" class="form-control" id="deskripsi" rows="3"></textarea>
                    </div>
                      <div class="form-group">
                        <label for="nama">Tanggal Mulai</label>
                        <input name="tanggal_mulai" type="date" value="{{ old('tanggal_mulai') }}" class="form-control" id="nama" placeholder="Masukkan nama kategori">
                    </div>
                    <div class="form-group">
                        <label for="nama">Tanggal Selesai</label>
                        <input name="tanggal_selesai" type="date" value="{{ old('tanggal_selesai') }}" class="form-control" id="nama" placeholder="Masukkan nama kategori">
                    </div>
                    <div class="form-group">
                      <label for="nama">Peserta</label>
                      <select name="peserta[]" class="select2" id="peserta" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                        
                      </select>
                  </div>
                    <div class="d-flex">  
                        <button type="submit" class="btn btn-primary mr-3">Simpan</button>
                        <a href="{{ route('agenda.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Guru</th>
                    <th>Agenda</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($teachers as $teacher)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $teacher->name }}</td>
                    <td>
                      @forelse($teacher->agendas as $agenda)
                        <li>{{ $agenda->agenda->title }} ({{ $agenda->agenda->tanggal_mulai }} - {{ $agenda->agenda->tanggal_selesai }})</li>
                      @empty
                        <li>Tidak ada agenda</li>
                      @endforelse
                    </td>
                    <td>
                      <button data-id="{{ $teacher->id }}" data-nama="{{ $teacher->name }}" class="btn btn-success btn-sm btn-tambah">Tambah</button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </section>
</div>
@endsection

@push('script')
<!-- Select2 -->
<script src="{{ asset('assets') }}/plugins/select2/js/select2.full.min.js"></script>
<script>
  $(function() {
    let data = [];

    //Initialize Select2 Elements
    $('#peserta').select2()

    $('#peserta').on('select2:unselect', function (e) {
      var removedOption = e.params.data;  // Data dari opsi yang dihapus
        console.log("Opsi dihapus: ", removedOption);

        // Menghapus opsi dari Select2
        $('#peserta').find('option[value="' + removedOption.id + '"]').remove();

        // Perbarui Select2 setelah menghapus opsi
        $('#peserta').trigger('change');

        console.log($('button[disabled]'));
        $('button[disabled]').map(function(){
          var btnId = $(this).data('id');
          if (btnId == removedOption.id) {
            $(this).attr('disabled', false);
          }
          // $(this).removeAttr('disabled');
        });
    });

    $('.btn-tambah').click(function(){
      var id = $(this).data('id');
      var nama = $(this).data('nama');

      $('#peserta').append('<option selected="selected" value="' + id + '">' + nama + '</option>');
      $(this).attr('disabled', 'disabled');
      // var parent = $(this).parent().parent();
      // parent.remove();
    })
  })
</script>
@endpush