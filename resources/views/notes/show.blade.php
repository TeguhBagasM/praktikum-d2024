@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="card">
        <div class="card-header">
            <h4>Detail Catatan</h4>
        </div>
        <div class="card-body">
            <p><strong>Judul:</strong> {{ $note->judul }}</p>
            <p><strong>Konten:</strong> {{ $note->konten }}</p>
            <p><strong>Tanggal Dibuat:</strong> {{ \Carbon\Carbon::parse($note->tanggal_dibuat)->locale('id')->translatedFormat('d F Y') }}</p>
            <a href="{{ route('notes.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
