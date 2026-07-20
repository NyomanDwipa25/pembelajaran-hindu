@extends('layouts.app')

@section('title', 'Dashboard Guru')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold text-white">
        <i class="bi bi-house-door me-2"></i> Dashboard Guru
    </h2>
    <p class="text-white opacity-75">Selamat datang kembali, {{ auth()->user()->name }}!</p>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-muted mb-2">Total Pembelajaran</h6>
                    <h2 class="fw-bold mb-0">{{ $totalLessons }}</h2>
                    <small class="text-success">
                        <i class="bi bi-arrow-up"></i> Materi aktif
                    </small>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <i class="bi bi-book text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-muted mb-2">Total Tugas</h6>
                    <h2 class="fw-bold mb-0">{{ $totalAssignments }}</h2>
                    <small class="text-info">
                        <i class="bi bi-clipboard-check"></i> Tugas diberikan
                    </small>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                    <i class="bi bi-clipboard-check text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-muted mb-2">Total Siswa</h6>
                    <h2 class="fw-bold mb-0">{{ $totalStudents }}</h2>
                    <small class="text-primary">
                        <i class="bi bi-people"></i> Siswa terdaftar
                    </small>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                    <i class="bi bi-people text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-lightning-charge me-2"></i> Aksi Cepat
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('lessons.create') }}" class="btn btn-primary w-100 py-3">
                            <i class="bi bi-plus-circle me-2"></i> Tambah Pembelajaran
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('assignments.create') }}" class="btn btn-success w-100 py-3">
                            <i class="bi bi-plus-circle me-2"></i> Tambah Tugas
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('attendances.index') }}" class="btn btn-info w-100 py-3">
                            <i class="bi bi-calendar-check me-2"></i> Lihat Absensi
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('attendances.report') }}" class="btn btn-warning w-100 py-3">
                            <i class="bi bi-file-earmark-text me-2"></i> Laporan Absen
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Submissions -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-clock-history me-2"></i> Pengumpulan Tugas Terbaru</span>
                <a href="{{ route('assignments.index') }}" class="btn btn-sm btn-light">
                    Lihat Semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="card-body">
                @if($recentSubmissions->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Siswa</th>
                                    <th>Tugas</th>
                                    <th>Waktu Pengumpulan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentSubmissions as $submission)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                                {{ strtoupper(substr($submission->user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $submission->user->name }}</div>
                                                <small class="text-muted">{{ $submission->user->kelas }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $submission->assignment->judul }}</div>
                                        <small class="text-muted">{{ $submission->assignment->kelas }}</small>
                                    </td>
                                    <td>
                                        <small>{{ $submission->submitted_at->diffForHumans() }}</small><br>
                                        <small class="text-muted">{{ $submission->submitted_at->format('d M Y, H:i') }}</small>
                                    </td>
                                    <td>
                                        @if($submission->nilai !== null)
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle me-1"></i> Nilai: {{ $submission->nilai }}
                                            </span>
                                        @else
                                            <span class="badge bg-warning">
                                                <i class="bi bi-clock me-1"></i> Belum dinilai
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('assignments.show', $submission->assignment_id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye me-1"></i> Lihat
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-inbox" style="font-size: 4rem; color: #e2e8f0;"></i>
                        <p class="text-muted mt-3">Belum ada pengumpulan tugas</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
