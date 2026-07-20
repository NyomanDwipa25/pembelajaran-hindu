@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold text-white">
        <i class="bi bi-house-door me-2"></i> Dashboard Siswa
    </h2>
    <p class="text-white opacity-75">Halo, {{ auth()->user()->name }}! Semangat belajar hari ini! 🌟</p>
</div>

<!-- Attendance Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
            <div class="card-body text-white">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="fw-bold mb-2">
                            <i class="bi bi-calendar-check me-2"></i> Absensi Hari Ini
                        </h4>
                        @if($todayAttendance)
                            <p class="mb-0 opacity-90">
                                Status: 
                                <span class="badge bg-light text-dark ms-2 px-3 py-2">
                                    @if($todayAttendance->status == 'hadir')
                                        <i class="bi bi-check-circle-fill text-success me-1"></i> HADIR
                                    @elseif($todayAttendance->status == 'izin')
                                        <i class="bi bi-info-circle-fill text-info me-1"></i> IZIN
                                    @elseif($todayAttendance->status == 'sakit')
                                        <i class="bi bi-heart-pulse-fill text-warning me-1"></i> SAKIT
                                    @else
                                        <i class="bi bi-x-circle-fill text-danger me-1"></i> ALPHA
                                    @endif
                                </span>
                            </p>
                            <small class="opacity-75">Tercatat pada {{ $todayAttendance->created_at->format('H:i') }}</small>
                        @else
                            <p class="mb-3 opacity-90">Anda belum melakukan absensi hari ini</p>
                            <a href="{{ route('attendances.create') }}" class="btn btn-light">
                                <i class="bi bi-check-circle me-2"></i> Absen Sekarang
                            </a>
                        @endif
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="bi bi-calendar-event" style="font-size: 5rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Latest Lessons -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-book me-2"></i> Pembelajaran Terbaru</span>
                <a href="{{ route('lessons.index') }}" class="btn btn-sm btn-light">
                    Lihat Semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="card-body">
                @if($lessons->count() > 0)
                    <div class="row">
                        @foreach($lessons as $lesson)
                        <div class="col-md-6 mb-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-book-half text-white" style="font-size: 1.5rem;"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="fw-bold mb-1">{{ $lesson->judul }}</h5>
                                            <div class="mb-2">
                                                <span class="badge bg-primary">{{ $lesson->tingkat }}</span>
                                                <span class="badge bg-info">{{ $lesson->kelas }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-muted small mb-3">{{ Str::limit($lesson->deskripsi, 100) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="bi bi-clock me-1"></i> {{ $lesson->created_at->diffForHumans() }}
                                        </small>
                                        <a href="{{ route('lessons.show', $lesson->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye me-1"></i> Lihat
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-book" style="font-size: 4rem; color: #e2e8f0;"></i>
                        <p class="text-muted mt-3">Belum ada pembelajaran tersedia</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Latest Assignments -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-clipboard-check me-2"></i> Tugas Terbaru</span>
                <a href="{{ route('assignments.index') }}" class="btn btn-sm btn-light">
                    Lihat Semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="card-body">
                @if($assignments->count() > 0)
                    <div class="row">
                        @foreach($assignments as $assignment)
                        <div class="col-md-6 mb-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-clipboard-check text-white" style="font-size: 1.5rem;"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="fw-bold mb-1">{{ $assignment->judul }}</h5>
                                            <div class="mb-2">
                                                <span class="badge bg-success">{{ $assignment->tingkat }}</span>
                                                <span class="badge bg-info">{{ $assignment->kelas }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-muted small mb-3">{{ Str::limit($assignment->deskripsi, 100) }}</p>
                                    <div class="mb-3">
                                        @php
                                            $deadline = \Carbon\Carbon::parse($assignment->tanggal_deadline);
                                            $now = \Carbon\Carbon::now();
                                            $daysLeft = $now->diffInDays($deadline, false);
                                        @endphp
                                        <small class="text-muted">
                                            <i class="bi bi-calendar-event me-1"></i> 
                                            Deadline: {{ $deadline->format('d M Y') }}
                                        </small>
                                        @if($daysLeft < 0)
                                            <span class="badge bg-danger ms-2">Terlewat</span>
                                        @elseif($daysLeft == 0)
                                            <span class="badge bg-warning ms-2">Hari Ini</span>
                                        @elseif($daysLeft <= 3)
                                            <span class="badge bg-warning ms-2">{{ $daysLeft }} hari lagi</span>
                                        @else
                                            <span class="badge bg-success ms-2">{{ $daysLeft }} hari lagi</span>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="bi bi-clock me-1"></i> {{ $assignment->created_at->diffForHumans() }}
                                        </small>
                                        <a href="{{ route('assignments.show', $assignment->id) }}" class="btn btn-sm btn-success">
                                            <i class="bi bi-eye me-1"></i> Lihat
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-clipboard" style="font-size: 4rem; color: #e2e8f0;"></i>
                        <p class="text-muted mt-3">Belum ada tugas tersedia</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
