@extends('layouts.app')

@section('title', 'Tambah Tugas')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold text-white">
        <i class="bi bi-plus-circle me-2"></i> Tambah Tugas Baru
    </h2>
    <p class="text-white opacity-75">Buat tugas untuk siswa</p>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-clipboard-check me-2"></i> Form Tugas
            </div>
            <div class="card-body">
                <form action="{{ route('assignments.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Judul Tugas <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                               placeholder="Contoh: Tugas Membuat Ringkasan Kitab Weda" value="{{ old('judul') }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tingkat <span class="text-danger">*</span></label>
                            <select name="tingkat" class="form-select @error('tingkat') is-invalid @enderror" required>
                                <option value="">Pilih Tingkat</option>
                                <option value="SD" {{ old('tingkat') == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{ old('tingkat') == 'SMP' ? 'selected' : '' }}>SMP</option>
                            </select>
                            @error('tingkat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kelas <span class="text-danger">*</span></label>
                            <select name="kelas" class="form-select @error('kelas') is-invalid @enderror" required>
                                <option value="">Pilih Kelas</option>
                                <option value="1 SD" {{ old('kelas') == '1 SD' ? 'selected' : '' }}>1 SD</option>
                                <option value="2 SD" {{ old('kelas') == '2 SD' ? 'selected' : '' }}>2 SD</option>
                                <option value="3 SD" {{ old('kelas') == '3 SD' ? 'selected' : '' }}>3 SD</option>
                                <option value="4 SD" {{ old('kelas') == '4 SD' ? 'selected' : '' }}>4 SD</option>
                                <option value="5 SD" {{ old('kelas') == '5 SD' ? 'selected' : '' }}>5 SD</option>
                                <option value="6 SD" {{ old('kelas') == '6 SD' ? 'selected' : '' }}>6 SD</option>
                                <option value="7 SMP" {{ old('kelas') == '7 SMP' ? 'selected' : '' }}>7 SMP</option>
                                <option value="8 SMP" {{ old('kelas') == '8 SMP' ? 'selected' : '' }}>8 SMP</option>
                                <option value="9 SMP" {{ old('kelas') == '9 SMP' ? 'selected' : '' }}>9 SMP</option>
                            </select>
                            @error('kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Deskripsi Tugas <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" rows="5" class="form-control @error('deskripsi') is-invalid @enderror" 
                                  placeholder="Tulis detail tugas dengan jelas..." required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i> Jelaskan instruksi tugas dengan detail agar siswa mudah memahami
                        </small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Tanggal Deadline <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_deadline" class="form-control @error('tanggal_deadline') is-invalid @enderror" 
                               value="{{ old('tanggal_deadline') }}" min="{{ date('Y-m-d') }}" required>
                        @error('tanggal_deadline')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i> Tentukan batas waktu pengumpulan tugas
                        </small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">File Lampiran (Opsional)</label>
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" 
                               accept=".pdf,.doc,.docx,.ppt,.pptx">
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i> Format: PDF, DOC, DOCX, PPT, PPTX (Max: 10MB)
                        </small>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save me-2"></i> Simpan Tugas
                        </button>
                        <a href="{{ route('assignments.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle me-2"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
