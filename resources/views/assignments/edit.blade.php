@extends('layouts.app')

@section('title', 'Edit Tugas')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold text-white">
        <i class="bi bi-pencil me-2"></i> Edit Tugas
    </h2>
    <p class="text-white opacity-75">Update detail tugas</p>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-clipboard-check me-2"></i> Form Tugas
            </div>
            <div class="card-body">
                <form action="{{ route('assignments.update', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Judul Tugas <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                               placeholder="Contoh: Tugas Membuat Ringkasan Kitab Weda" value="{{ old('judul', $assignment->judul) }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tingkat <span class="text-danger">*</span></label>
                            <select name="tingkat" class="form-select @error('tingkat') is-invalid @enderror" required>
                                <option value="">Pilih Tingkat</option>
                                <option value="SD" {{ old('tingkat', $assignment->tingkat) == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{ old('tingkat', $assignment->tingkat) == 'SMP' ? 'selected' : '' }}>SMP</option>
                            </select>
                            @error('tingkat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kelas <span class="text-danger">*</span></label>
                            <select name="kelas" class="form-select @error('kelas') is-invalid @enderror" required>
                                <option value="">Pilih Kelas</option>
                                <option value="1 SD" {{ old('kelas', $assignment->kelas) == '1 SD' ? 'selected' : '' }}>1 SD</option>
                                <option value="2 SD" {{ old('kelas', $assignment->kelas) == '2 SD' ? 'selected' : '' }}>2 SD</option>
                                <option value="3 SD" {{ old('kelas', $assignment->kelas) == '3 SD' ? 'selected' : '' }}>3 SD</option>
                                <option value="4 SD" {{ old('kelas', $assignment->kelas) == '4 SD' ? 'selected' : '' }}>4 SD</option>
                                <option value="5 SD" {{ old('kelas', $assignment->kelas) == '5 SD' ? 'selected' : '' }}>5 SD</option>
                                <option value="6 SD" {{ old('kelas', $assignment->kelas) == '6 SD' ? 'selected' : '' }}>6 SD</option>
                                <option value="7 SMP" {{ old('kelas', $assignment->kelas) == '7 SMP' ? 'selected' : '' }}>7 SMP</option>
                                <option value="8 SMP" {{ old('kelas', $assignment->kelas) == '8 SMP' ? 'selected' : '' }}>8 SMP</option>
                                <option value="9 SMP" {{ old('kelas', $assignment->kelas) == '9 SMP' ? 'selected' : '' }}>9 SMP</option>
                            </select>
                            @error('kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Deskripsi Tugas <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" rows="5" class="form-control @error('deskripsi') is-invalid @enderror" 
                                  placeholder="Tulis detail tugas dengan jelas..." required>{{ old('deskripsi', $assignment->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Tanggal Deadline <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_deadline" class="form-control @error('tanggal_deadline') is-invalid @enderror" 
                               value="{{ old('tanggal_deadline', $assignment->tanggal_deadline->format('Y-m-d')) }}" required>
                        @error('tanggal_deadline')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @if($assignment->file)
                    <div class="mb-3">
                        <label class="form-label fw-semibold">File Saat Ini</label>
                        <div class="alert alert-info">
                            <i class="bi bi-file-earmark-text me-2"></i>
                            <a href="{{ route('files.download', [explode('/', $assignment->file)[0], basename($assignment->file)]) }}" class="text-decoration-none">
                                {{ basename($assignment->file) }}
                            </a>
                        </div>
                    </div>
                    @endif

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Ganti File Lampiran (Opsional)</label>
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
                            <i class="bi bi-save me-2"></i> Update Tugas
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
