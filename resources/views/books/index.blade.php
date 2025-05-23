@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Data Buku</h3>
            <a href="{{ route('books.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Buku
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($books->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>judul</th>
                                <th>penulis</th>
                                <th>status</th>
                                <th>kategori</th>
                                <th>tahun terbit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $data->judul }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ $data->penulis }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge 
                                            @if($data->status == 'tersedia') bg-success
                                            @elseif($data->status == 'dipinjam') bg-warning
                                            @else bg-info
                                            @endif">
                                            {{ $data->status }}
                                        </span>
                                    </td>
                                    <td>
                                       {{ $data->kategori }}
                                    </td>
                                    
                                    <td>
                                        <small class="text-muted">
                                            {{ $data->created_at->format('d/m/Y') }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('books.show', $data->id) }}" 
                                               class="btn btn-outline-info" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('books.edit', $data->id) }}" 
                                               class="btn btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('books.destroy', $data->id) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus book {{ $data->nama }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-outline-danger" 
                                                        title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Statistik -->
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body text-center">
                                <h4>{{ $books->count() }}</h4>
                                <small>Total book</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center">
                                <h4>{{ $books->where('isActive', true)->count() }}</h4>
                                <small>book Aktif</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-danger text-white">
                            <div class="card-body text-center">
                                <h4>{{ $books->where('isActive', false)->count() }}</h4>
                                <small>book Tidak Aktif</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-dark">
                            <div class="card-body text-center">
                                <h4>{{ $books->whereNull('user_id')->count() }}</h4>
                                <small>Tanpa User</small>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada data book</h5>
                    
                </div>
            @endif
        </div>
    </div>
</div>
@endsection