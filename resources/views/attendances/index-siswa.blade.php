@extends('layouts.app')

@section('title', 'Absensi Saya')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold text-white">
        <i class="bi bi-calendar-check me-2"></i> Absensi Saya
    </h2>
    <p class="text-white opacity-75">Riwayat kehadiran Anda</p>
</div>

<!-- Today's Attendance Card -->
<div class="card mb-4">
    <div class="card-body">
        @if($todayAttendance)
            <div class="text-center py-4">
                <div style="width: 100px; height: 100px; margin: 0 auto; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-check-circle text-white" style="font-size: 3rem;"></i>
                </div>
                <h4 class="fw-bold mt-4 mb-2">Absensi Hari Ini Sudah Tercatat! ✅</h4>
                <div class="mb-3">
                    <span class="badge px-4 py-2" style="font-size: 1.1rem;
                        @if($todayAttendance->status == 'hadir') background: linear-gradient(135deg, #10b981 0%, #059669 100%);
                        @elseif($todayAttendance->status == 'izin') background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
                        @elseif($todayAttendance->status == 'sakit') background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
                        @else background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
                        @endif">
                        {{ strtoupper($todayAttendance->status) }}
                    </span>
                </div>
                <p class="text-muted">Tercatat pada {{ $todayAttendance->created_at->format('H:i') }} WIB</p>
                @if($todayAttendance->keterangan)
                <div class="mt-3 p-3" style="background: #f8f9fa; border-radius: 15px; max-width: 500px; margin: 0 auto;">
                    <small class="text-muted d-block mb-1">Keterangan:</small>
                    <p class="mb-0">{{ $todayAttendance->keterangan }}</p>
                </div>
                @endif
            </div>
        @else
            <div class="text-center py-4">
                <div style="width: 100px; height: 100px; margin: 0 auto; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-exclamation-circle text-white" style="font-size: 3rem;"></i>
                </div>
                <h4 class="fw-bold mt-4 mb-2">Belum Absen Hari Ini ⚠️</h4>
                <p class="text-muted mb-4">Jangan lupa untuk melakukan absensi harian</p>
                <a href="{{ route('attendances.create') }}" class="btn btn-success btn-lg">
                    <i class="bi bi-check-circle me-2"></i> Absen Sekarang
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Attendance History -->
<div class="card">
    <div class="card-header">
        <i class="bi bi-clock-history me-2"></i> Riwayat Absensi
    </div>
    <div class="card-body">
        @if($attendances->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Hari</th>
                            <th>Status</th>
                            <th>Waktu Absen</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $attendance)
                        <tr>
                            <td>
                                <strong>{{ $attendance->tanggal->format('d M Y') }}</strong>
                            </td>
                            <td>{{ $attendance->tanggal->locale('id')->dayName }}</td>
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
                                <small class="text-muted">{{ $attendance->created_at->format('H:i') }} WIB</small>
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
                <h5 class="text-muted mt-3">Belum ada riwayat absensi</h5>
            </div>
        @endif
    </div>
</div>
@endsection
