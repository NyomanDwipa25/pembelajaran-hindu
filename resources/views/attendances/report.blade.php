@extends('layouts.app')

@section('title', 'Laporan Absensi')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold text-white">
        <i class="bi bi-file-earmark-text me-2"></i> Laporan Absensi
    </h2>
    <p class="text-white opacity-75">Lihat rekap absensi siswa berdasarkan periode</p>
</div>

<!-- Filter Card -->
<div class="card mb-4">
    <div class="card-header">
        <i class="bi bi-funnel me-2"></i> Filter Periode
    </div>
    <div class="card-body">
        <form action="{{ route('attendances.report') }}" method="GET">
            <div class="row">
                <div class="col-md-5">
                    <label class="form-label fw-semibold">Tanggal Mulai</label>
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date', $startDate) }}">
                </div>
                <div class="col-md-5">
                    <label class="form-label fw-semibold">Tanggal Akhir</label>
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date', $endDate) }}">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i> Filter
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Summary Statistics -->
@php
    $totalAttendances = $attendances->count();
    $hadirCount = $attendances->where('status', 'hadir')->count();
    $izinCount = $attendances->where('status', 'izin')->count();
    $sakitCount = $attendances->where('status', 'sakit')->count();
    $alphaCount = $attendances->where('status', 'alpha')->count();
@endphp

<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-muted mb-2">Total Absensi</h6>
                    <h2 class="fw-bold mb-0">{{ $totalAttendances }}</h2>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <i class="bi bi-list-check text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-muted mb-2">Hadir</h6>
                    <h2 class="fw-bold mb-0 text-success">{{ $hadirCount }}</h2>
                    <small class="text-muted">{{ $totalAttendances > 0 ? round(($hadirCount / $totalAttendances) * 100, 1) : 0 }}%</small>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                    <i class="bi bi-check-circle text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-muted mb-2">Izin / Sakit</h6>
                    <h2 class="fw-bold mb-0 text-warning">{{ $izinCount + $sakitCount }}</h2>
                    <small class="text-muted">{{ $totalAttendances > 0 ? round((($izinCount + $sakitCount) / $totalAttendances) * 100, 1) : 0 }}%</small>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                    <i class="bi bi-info-circle text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-muted mb-2">Alpha</h6>
                    <h2 class="fw-bold mb-0 text-danger">{{ $alphaCount }}</h2>
                    <small class="text-muted">{{ $totalAttendances > 0 ? round(($alphaCount / $totalAttendances) * 100, 1) : 0 }}%</small>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                    <i class="bi bi-x-circle text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Attendance Table -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>
            <i class="bi bi-table me-2"></i> 
            Data Absensi: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}
        </span>
        <button onclick="window.print()" class="btn btn-sm btn-success">
            <i class="bi bi-printer me-1"></i> Cetak
        </button>
    </div>
    <div class="card-body">
        @if($attendances->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Status</th>
                            <th>Waktu</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $index => $attendance)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $attendance->tanggal->format('d M Y') }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-3" style="width: 35px; height: 35px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 0.9rem;">
                                        {{ strtoupper(substr($attendance->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $attendance->user->name }}</div>
                                        <small class="text-muted">{{ $attendance->user->no_induk }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $attendance->user->kelas }}</span>
                            </td>
                            <td>
                                @if($attendance->status == 'hadir')
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i> Hadir
                                    </span>
                                @elseif($attendance->status == 'izin')
                                    <span class="badge bg-info">
                                        <i class="bi bi-info-circle me-1"></i> Izin
                                    </span>
                                @elseif($attendance->status == 'sakit')
                                    <span class="badge bg-warning">
                                        <i class="bi bi-heart-pulse me-1"></i> Sakit
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="bi bi-x-circle me-1"></i> Alpha
                                    </span>
                                @endif
                            </td>
                            <td>
                                <small>{{ $attendance->created_at->format('H:i') }} WIB</small>
                            </td>
                            <td>
                                @if($attendance->keterangan)
                                    <small>{{ Str::limit($attendance->keterangan, 40) }}</small>
                                @else
                                    <small class="text-muted">-</small>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 5rem; color: #e2e8f0;"></i>
                <h5 class="text-muted mt-3">Tidak ada data absensi</h5>
                <p class="text-muted">Coba ubah filter periode untuk melihat data</p>
            </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    @media print {
        body {
            background: white !important;
        }
        .navbar, .sidebar, .btn, .pagination {
            display: none !important;
        }
        .card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }
        .main-content {
            padding: 0 !important;
        }
    }
</style>
@endpush
@endsection
