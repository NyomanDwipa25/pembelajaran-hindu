@extends('layouts.app')

@section('title', 'Daftar Absensi')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold text-white">
        <i class="bi bi-calendar-check me-2"></i> Daftar Absensi Hari Ini
    </h2>
    <p class="text-white opacity-75">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    @php
        $hadir = $attendances->where('status', 'hadir')->count();
        $izin = $attendances->where('status', 'izin')->count();
        $sakit = $attendances->where('status', 'sakit')->count();
        $alpha = $attendances->where('status', 'alpha')->count();
        $total = $attendances->count();
    @endphp

    <div class="col-md-3 mb-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-muted mb-2">Total Absen</h6>
                    <h2 class="fw-bold mb-0">{{ $total }}</h2>
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
                    <h6 class="text-muted mb-2">Hadir</h6>
                    <h2 class="fw-bold mb-0 text-success">{{ $hadir }}</h2>
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
                    <h2 class="fw-bold mb-0 text-warning">{{ $izin + $sakit }}</h2>
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
                    <h2 class="fw-bold mb-0 text-danger">{{ $alpha }}</h2>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                    <i class="bi bi-x-circle text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Attendance List -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-list-ul me-2"></i> Daftar Absensi</span>
        <a href="{{ route('attendances.report') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-file-earmark-text me-1"></i> Lihat Laporan
        </a>
    </div>
    <div class="card-body">
        @if($attendances->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Status</th>
                            <th>Waktu Absen</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $index => $attendance)
                        <tr>
                            <td>{{ $attendances->firstItem() + $index }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
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
                                    <small>{{ Str::limit($attendance->keterangan, 50) }}</small>
                                @else
                                    <small class="text-muted">-</small>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $attendances->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-calendar-x" style="font-size: 5rem; color: #e2e8f0;"></i>
                <h5 class="text-muted mt-3">Belum ada absensi hari ini</h5>
                <p class="text-muted">Siswa akan muncul di sini ketika melakukan absensi</p>
            </div>
        @endif
    </div>
</div>

<!-- All Students List -->
<div class="card mt-4">
    <div class="card-header">
        <i class="bi bi-people me-2"></i> Daftar Semua Siswa
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
                            <th>Status Hari Ini</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $index => $student)
                        @php
                            $todayAttendance = $attendances->where('user_id', $student->id)->first();
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                        {{ strtoupper(substr($student->name, 0, 1)) }}
                                    </div>
                                    <strong>{{ $student->name }}</strong>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $student->kelas }}</span>
                            </td>
                            <td>{{ $student->no_induk ?? '-' }}</td>
                            <td>
                                @if($todayAttendance)
                                    @if($todayAttendance->status == 'hadir')
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle me-1"></i> Hadir
                                        </span>
                                    @elseif($todayAttendance->status == 'izin')
                                        <span class="badge bg-info">
                                            <i class="bi bi-info-circle me-1"></i> Izin
                                        </span>
                                    @elseif($todayAttendance->status == 'sakit')
                                        <span class="badge bg-warning">
                                            <i class="bi bi-heart-pulse me-1"></i> Sakit
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="bi bi-x-circle me-1"></i> Alpha
                                        </span>
                                    @endif
                                @else
                                    <span class="badge bg-secondary">
                                        <i class="bi bi-dash-circle me-1"></i> Belum Absen
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-people" style="font-size: 5rem; color: #e2e8f0;"></i>
                <h5 class="text-muted mt-3">Belum ada siswa terdaftar</h5>
            </div>
        @endif
    </div>
</div>
@endsection
