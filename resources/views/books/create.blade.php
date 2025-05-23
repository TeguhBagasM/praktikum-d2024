@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Tambah Buku</h3>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('books.store') }}" method="POST">
                @csrf
                
                <div class="form-group my-2">
                    <label for="judul">Judul Buku <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('judul') is-invalid @enderror" 
                           name="judul" 
                           id="judul" 
                           value="{{ old('judul') }}" 
                           placeholder="Masukkan judul buku"
                           autofocus>
                    @error('judul')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- NIM -->
                <div class="form-group my-2">
                    <label for="penulis">penulis <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('penulis') is-invalid @enderror" 
                           name="penulis" 
                           id="penulis" 
                           value="{{ old('penulis') }}" 
                           placeholder="Masukkan penulis">
                    @error('penulis')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group my-2">
                    <label for="tahun_terbit">tahun terbit <span class="text-danger">*</span></label>
                    <input type="number" 
                           class="form-control @error('tahun_terbit') is-invalid @enderror" 
                           name="tahun_terbit" 
                           id="tahun_terbit" 
                           value="{{ old('tahun_terbit') }}" 
                           placeholder="Masukukan tahun terbit">
                    @error('tahun_terbit')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group my-2">
                    <label for="kategori">kategori <span class="text-danger">*</span></label>
                    <input type="year" 
                           class="form-control @error('kategori') is-invalid @enderror" 
                           name="kategori" 
                           id="kategori" 
                           value="{{ old('kategori') }}" 
                           placeholder="Masukukan kategori ">
                    @error('kategori')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group my-2">
                    <label for="status">status <span class="text-danger">*</span></label>
                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                        <option value="">-- Pilih Status --</option>
                        <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>tersedia</option>
                        <option value="dipinjam" {{ old('status') == 'dipinjam' ? 'selected' : '' }}>dipinjam</option>
                    </select>
                    @error('status')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Buku
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection