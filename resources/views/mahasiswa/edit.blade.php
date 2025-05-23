@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Edit Mahasiswa</h3>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
        <div class="card-body">
            <!-- Debug Info -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Info User Terkait -->
                @if($mahasiswa->user)
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Info User Terkait:</strong> 
                        {{ $mahasiswa->user->name }} ({{ $mahasiswa->user->email }})
                    </div>
                @endif

                <!-- Nama Mahasiswa -->
                <div class="form-group my-2">
                    <label for="nama">Nama Mahasiswa <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('nama') is-invalid @enderror" 
                           name="nama" 
                           id="nama" 
                           value="{{ old('nama', $mahasiswa->nama) }}" 
                           placeholder="Masukkan nama lengkap mahasiswa"
                           autofocus
                           required>
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
                           value="{{ old('nim', $mahasiswa->nim) }}" 
                           placeholder="Masukkan NIM mahasiswa"
                           required>
                    @error('nim')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Program Studi -->
                <div class="form-group my-2">
                    <label for="prodi">Program Studi <span class="text-danger">*</span></label>
                    <select class="form-control @error('prodi') is-invalid @enderror" name="prodi" id="prodi" required>
                        <option value="">-- Pilih Program Studi --</option>
                        <option value="IFSI-S1" {{ old('prodi', $mahasiswa->prodi) == 'IFSI-S1' ? 'selected' : '' }}>IFSI-S1</option>
                        <option value="KA-D3" {{ old('prodi', $mahasiswa->prodi) == 'KA-D3' ? 'selected' : '' }}>KA-D3</option>
                        <option value="MI-D3" {{ old('prodi', $mahasiswa->prodi) == 'MI-D3' ? 'selected' : '' }}>MI-D3</option>
                        <option value="IF-D3" {{ old('prodi', $mahasiswa->prodi) == 'IF-D3' ? 'selected' : '' }}>IF-D3</option>
                    </select>
                    @error('prodi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Status Aktif -->
                <div class="form-group my-2">
                    <label>Status Mahasiswa <span class="text-danger">*</span></label>
                    <div class="mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" 
                                   type="radio" 
                                   name="isActive" 
                                   id="aktif" 
                                   value="1" 
                                   {{ old('isActive', $mahasiswa->isActive) == '1' ? 'checked' : '' }}
                                   required>
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
                                   {{ old('isActive', $mahasiswa->isActive) == '0' ? 'checked' : '' }}
                                   required>
                            <label class="form-check-label" for="tidak_aktif">
                                Tidak Aktif
                            </label>
                        </div>
                    </div>
                    @error('isActive')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Pilihan User (Optional) -->
                <div class="form-group my-2">
                    <label for="user_id">User Terkait (Opsional)</label>
                    <select class="form-control @error('user_id') is-invalid @enderror" name="user_id" id="user_id">
                        <option value="">-- Tidak ada user --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" 
                                {{ old('user_id', $mahasiswa->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="text-muted">Kosongkan jika mahasiswa tidak memiliki akun user</small>
                </div>

                <!-- Update User Info -->
                @if($mahasiswa->user)
                    <div class="card bg-light mt-3">
                        <div class="card-header">
                            <h6 class="mb-0">Update Info User</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group my-2">
                                <label for="user_email">Email User</label>
                                <input type="email" 
                                       class="form-control @error('user_email') is-invalid @enderror" 
                                       name="user_email" 
                                       id="user_email" 
                                       value="{{ old('user_email', $mahasiswa->user->email) }}" 
                                       placeholder="Update email user">
                                @error('user_email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="update_user_name" id="update_user_name" value="1" checked>
                                <label class="form-check-label" for="update_user_name">
                                    Update nama user sesuai nama mahasiswa
                                </label>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Mahasiswa
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- 
@push('scripts')
<script>
    // Debug form submission
    document.querySelector('form').addEventListener('submit', function(e) {
        console.log('Form submitted');
        console.log('Action:', this.action);
        console.log('Method:', this.method);
    });
</script>
@endpush --}}

@endsection