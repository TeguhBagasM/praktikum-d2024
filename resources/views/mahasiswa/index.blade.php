@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Data Mahasiswa</h3>
            <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Mahasiswa
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($mahasiswa->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th>Email User</th>
                                <th>Status</th>
                                <th>Tgl Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mahasiswa as $index => $mhs)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $mhs->nim }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ $mhs->nama }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge 
                                            @if($mhs->prodi == 'IFSI-S1') bg-primary
                                            @elseif($mhs->prodi == 'KA-D3') bg-success
                                            @elseif($mhs->prodi == 'MI-D3') bg-warning
                                            @else bg-info
                                            @endif">
                                            {{ $mhs->prodi }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($mhs->user)
                                            <small class="text-muted">{{ $mhs->user->email }}</small>
                                        @else
                                            <span class="text-danger">Tidak ada user</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($mhs->isActive)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $mhs->created_at->format('d/m/Y') }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('mahasiswa.show', $mhs->id) }}" 
                                               class="btn btn-outline-info" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('mahasiswa.edit', $mhs->id) }}" 
                                               class="btn btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus mahasiswa {{ $mhs->nama }}?')">
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
                                <h4>{{ $mahasiswa->count() }}</h4>
                                <small>Total Mahasiswa</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center">
                                <h4>{{ $mahasiswa->where('isActive', true)->count() }}</h4>
                                <small>Mahasiswa Aktif</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-danger text-white">
                            <div class="card-body text-center">
                                <h4>{{ $mahasiswa->where('isActive', false)->count() }}</h4>
                                <small>Mahasiswa Tidak Aktif</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-dark">
                            <div class="card-body text-center">
                                <h4>{{ $mahasiswa->whereNull('user_id')->count() }}</h4>
                                <small>Tanpa User</small>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada data mahasiswa</h5>
                    
                </div>
            @endif
        </div>
    </div>
</div>
@endsection