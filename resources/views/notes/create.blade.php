@extends('layouts.app')
@section('content')

<div class="container">

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Tambah Catatan</h3>
        <a href="{{ route('notes.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
    <div class="card-body">
      <form action="{{ route('notes.store') }}" method="POST">
        @csrf
        <div class="form-group my-2">
          <label for="judul">Judul</label>
          <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" id="judul" value="{{ old('judul') }}" autofocus>
          @error('judul')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
        <div class="form-group my-o2">
          <label for="isActive">isActive</label>
          <input type="radio" name="isActive" id="isActive" value="1"> Aktif
          <input type="radio" name="isActive" id="isActive" value="0"> Tidak Aktif
        </div>
        <div class="form-group my-2">
          <label for="konten">Konten</label>
          <textarea class="form-control @error('konten') is-invalid @enderror" name="konten" id="konten">{{ old('konten') }}</textarea>
          @error('konten')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
        <div class="form-group my-2">
          <label for="tanggal_dibuat">Tanggal dibuat</label>
          <input type="date" class="form-control @error('tanggal_dibuat') is-invalid @enderror" name="tanggal_dibuat" id="tanggal_dibuat" value="{{ old('tanggal_dibuat') }}">
          @error('tanggal_dibuat')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      
    </div>
</div>
</div>

@endsection