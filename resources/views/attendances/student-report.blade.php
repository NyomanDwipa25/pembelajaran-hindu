@extends('layouts.app')

@section('title', 'Laporan Kehadiran Per Siswa')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold text-white">
        <i class="bi bi-people me-2"></i> Laporan Kehadiran Per Siswa
    </h2>
    <p class="text-white opacity-75">Rekap kehadiran setiap siswa berdasarkan periode</p>
</div>

<!-- Filter Card -->
<div class="card mb-4">
    <div class="card-header">
        <i class="bi bi-funnel me-2"></i> Filter Periode
    </div>
    <div class="card-body">
        <form action="{{ route('student.attendance.report') }}" method="GET">
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
    $totalSiswa = $students->count();
    $totalHadirAll = $students->sum('total_hadir');
    $totalIzinAll = $students->sum('total_izin');
    $totalSakitAll = $students->sum('total_sakit');
    $totalAlphaAll = $students->sum('total_alpha');
    $totalKehadiranAll = $students->sum('total_kehadiran');
@endphp

<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-muted mb-2">Total Siswa</h6>
                    <h2 class="fw-bold mb-0">{{ $totalSiswa }}</h2>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <i class="bi bi-people text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-muted mb-2">Total Hadir</h6>
                    <h2 class="fw-bold mb-0 text-success">{{ $totalHadirAll }}</h2>
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
                    <h6 class="text-muted mb-2">Total Izin/Sakit</h6>
                    <h2 class="fw-bold mb-0 text-warning">{{ $totalIzinAll + $totalSakitAll }}</h2>
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
                    <h6 class="text-muted mb-2">Total Alpha</h6>
                    <h2 class="fw-bold mb-0 text-danger">{{ $totalAlphaAll }}</h2>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                    <i class="bi bi-x-circle text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Student Table -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>
            <i class="bi bi-table me-2"></i> 
            Rekap Kehadiran Siswa: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}
        </span>
        <button onclick="window.print()" class="btn btn-sm btn-success">
            <i class="bi bi-printer me-1"></i> Cetak
        </button>
    </div>
    <div class="card-body">
        @if($students->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>No. Induk</th>
                            <th class="text-center">Hadir</th>
                            <th class="text-center">Izin</th>
                            <th class="text-center">Sakit</th>
                            <th class="text-center">Alpha</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Persentase Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $index => $student)
                        @php
                            $persentase = $student->total_kehadiran > 0 
                                ? round(($student->total_hadir / $student->total_kehadiran) * 100, 1) 
                                : 0;
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-3" style="width: 35px; height: 35px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 0.9rem;">
                                        {{ strtoupper(substr($student->name, 0, 1)) }}
                                    </div>
                                    <strong>{{ $student->name }}</strong>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $student->kelas }}</span>
                            </td>
                            <td>{{ $student->no_induk ?? '-' }}</td>
                            <td class="text-center">
                                <span class="badge bg-success">{{ $student->total_hadir }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-info">{{ $student->total_izin }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-warning">{{ $student->total_sakit }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-danger">{{ $student->total_alpha }}</span>
                            </td>
                            <td class="text-center">
                                <strong>{{ $student->total_kehadiran }}</strong>
                            </td>
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="progress" style="width: 100px; height: 25px;">
                                        <div class="progress-bar 
                                            @if($persentase >= 90) bg-success
                                            @elseif($persentase >= 75) bg-primary
                                            @elseif($persentase >= 60) bg-warning
                                            @else bg-danger
                                            @endif" 
                                            role="progressbar" 
                                            style="width: {{ $persentase }}%;" 
                                            aria-valuenow="{{ $persentase }}" 
                                            aria-valuemin="0" 
                                            aria-valuemax="100">
                                            <strong>{{ $persentase }}%</strong>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-secondary">
                            <th colspan="4" class="text-end">TOTAL:</th>
                            <th class="text-center">{{ $totalHadirAll }}</th>
                            <th class="text-center">{{ $totalIzinAll }}</th>
                            <th class="text-center">{{ $totalSakitAll }}</th>
                            <th class="text-center">{{ $totalAlphaAll }}</th>
                            <th class="text-center">{{ $totalKehadiranAll }}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 5rem; color: #e2e8f0;"></i>
                <h5 class="text-muted mt-3">Belum ada data siswa</h5>
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
        .navbar, .sidebar, .btn, .card-header button {
            display: none !important;
        }
        .card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }
        .main-content {
            padding: 0 !important;
        }
        .progress {
            border: 1px solid #ddd;
        }
    }
</style>
@endpush
@endsection
