@extends('layouts.app')

@section('title', 'Absen Hari Ini')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold text-white">
        <i class="bi bi-calendar-check me-2"></i> Absen Hari Ini
    </h2>
    <p class="text-white opacity-75">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
</div>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-check-circle me-2"></i> Form Absensi
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <div style="width: 100px; height: 100px; margin: 0 auto; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-person-check text-white" style="font-size: 3rem;"></i>
                    </div>
                    <h5 class="fw-bold mt-3">{{ auth()->user()->name }}</h5>
                    <p class="text-muted">{{ auth()->user()->kelas }}</p>
                </div>

                <form action="{{ route('attendances.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Status Kehadiran <span class="text-danger">*</span></label>
                        
                        <div class="row g-3">
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="status" id="hadir" value="hadir" checked>
                                <label class="btn btn-outline-success w-100 py-3" for="hadir">
                                    <i class="bi bi-check-circle d-block mb-2" style="font-size: 2rem;"></i>
                                    <strong>Hadir</strong>
                                </label>
                            </div>
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="status" id="izin" value="izin">
                                <label class="btn btn-outline-info w-100 py-3" for="izin">
                                    <i class="bi bi-info-circle d-block mb-2" style="font-size: 2rem;"></i>
                                    <strong>Izin</strong>
                                </label>
                            </div>
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="status" id="sakit" value="sakit">
                                <label class="btn btn-outline-warning w-100 py-3" for="sakit">
                                    <i class="bi bi-heart-pulse d-block mb-2" style="font-size: 2rem;"></i>
                                    <strong>Sakit</strong>
                                </label>
                            </div>
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="status" id="alpha" value="alpha">
                                <label class="btn btn-outline-danger w-100 py-3" for="alpha">
                                    <i class="bi bi-x-circle d-block mb-2" style="font-size: 2rem;"></i>
                                    <strong>Alpha</strong>
                                </label>
                            </div>
                        </div>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Keterangan (Opsional)</label>
                        <textarea name="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror" 
                                  placeholder="Tulis keterangan jika perlu (misal: izin karena ada keperluan keluarga)">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Perhatian:</strong> Absensi hanya dapat dilakukan sekali per hari. Pastikan status kehadiran Anda sudah benar sebelum menyimpan.
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success flex-grow-1 btn-lg">
                            <i class="bi bi-check-circle me-2"></i> Simpan Absensi
                        </button>
                        <a href="{{ route('attendances.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
