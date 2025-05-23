@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="card">
        <div class="card-header">
            <h4>Edit Catatan</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('notes.update', $note->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $note->judul) }}">
                    @error('judul') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="konten">Konten</label>
                    <textarea name="konten" id="konten" class="form-control @error('konten') is-invalid @enderror">{{ old('konten', $note->konten) }}</textarea>
                    @error('konten') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="tanggal_dibuat">Tanggal Dibuat</label>
                    <input type="date" name="tanggal_dibuat" id="tanggal_dibuat" class="form-control @error('tanggal_dibuat') is-invalid @enderror" value="{{ old('tanggal_dibuat', $note->tanggal_dibuat) }}">
                    @error('tanggal_dibuat') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('notes.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
