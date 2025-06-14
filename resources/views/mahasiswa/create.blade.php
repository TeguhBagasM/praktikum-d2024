@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Tambah Mahasiswa</h3>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf
                
                <!-- Nama Mahasiswa -->
                <div class="form-group my-2">
                    <label for="nama">Nama Mahasiswa <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('nama') is-invalid @enderror" 
                           name="nama" 
                           id="nama" 
                           value="{{ old('nama') }}" 
                           placeholder="Masukkan nama lengkap mahasiswa"
                           autofocus>
                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- NIM -->
                <div class="form-group my-2">
                    <label for="nim">NIM <span class="text-danger">*</span></label>
                    <input type="number" 
                           class="form-control @error('nim') is-invalid @enderror" 
                           name="nim" 
                           id="nim" 
                           value="{{ old('nim') }}" 
                           placeholder="Masukkan NIM mahasiswa">
                    @error('nim')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="text-muted">NIM akan digunakan sebagai password default</small>
                </div>

                <!-- Email -->
                <div class="form-group my-2">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           name="email" 
                           id="email" 
                           value="{{ old('email') }}" 
                           placeholder="Masukukan email mahasiswa">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Program Studi -->
                <div class="form-group my-2">
                    <label for="prodi">Program Studi <span class="text-danger">*</span></label>
                    <select class="form-control @error('prodi') is-invalid @enderror" name="prodi" id="prodi">
                        <option value="">-- Pilih Program Studi --</option>
                        <option value="IFSI-S1" {{ old('prodi') == 'IFSI-S1' ? 'selected' : '' }}>IFSI-S1</option>
                        <option value="KA-D3" {{ old('prodi') == 'KA-D3' ? 'selected' : '' }}>KA-D3</option>
                        <option value="MI-D3" {{ old('prodi') == 'MI-D3' ? 'selected' : '' }}>MI-D3</option>
                        <option value="IF-D3" {{ old('prodi') == 'IF-D3' ? 'selected' : '' }}>IF-D3</option>
                    </select>
                    @error('prodi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                

                <!-- Status Aktif -->
                <div class="form-group my-2">
                    <label>Status Mahasiswa</label>
                    <div class="mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" 
                                   type="radio" 
                                   name="isActive" 
                                   id="aktif" 
                                   value="1" 
                                   {{ old('isActive', '1') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="aktif">
                                Aktif
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" 
                                   type="radio" 
                                   name="isActive" 
                                   id="tidak_aktif" 
                                   value="0" 
                                   {{ old('isActive') == '0' ? 'checked' : '' }}>
                            <label class="form-check-label" for="tidak_aktif">
                                Tidak Aktif
                            </label>
                        </div>
                    </div>
                    @error('isActive')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>



                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Mahasiswa
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto generate email based on nama (optional)
    document.getElementById('nama').addEventListener('input', function() {
        let nama = this.value.toLowerCase().replace(/\s+/g, '');
        if (nama) {
            document.getElementById('email').value = nama + '@stmik-mi.ac.id';
        }
    });
</script>
@endpush

@endsection