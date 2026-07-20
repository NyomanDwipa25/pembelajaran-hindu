@extends('layouts.app')

@section('title', 'Daftar Tugas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-white">
            <i class="bi bi-clipboard-check me-2"></i> Daftar Tugas
        </h2>
        <p class="text-white opacity-75">Kelola dan kerjakan tugas pembelajaran</p>
    </div>
    @if(auth()->user()->isGuru())
    <a href="{{ route('assignments.create') }}" class="btn btn-light btn-lg">
        <i class="bi bi-plus-circle me-2"></i> Tambah Tugas
    </a>
    @endif
</div>

<div class="card">
    <div class="card-body">
        @if($assignments->count() > 0)
            <div class="row">
                @foreach($assignments as $assignment)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-clipboard-check text-white" style="font-size: 2rem;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fw-bold mb-1">{{ $assignment->judul }}</h5>
                                    <div>
                                        <span class="badge bg-success">{{ $assignment->tingkat }}</span>
                                        <span class="badge bg-info">{{ $assignment->kelas }}</span>
                                    </div>
                                </div>
                            </div>

                            <p class="text-muted mb-3 flex-grow-1">{{ Str::limit($assignment->deskripsi, 120) }}</p>

                            <div class="mb-3">
                                @php
                                    $deadline = \Carbon\Carbon::parse($assignment->tanggal_deadline);
                                    $now = \Carbon\Carbon::now();
                                    $daysLeft = $now->diffInDays($deadline, false);
                                @endphp
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-calendar-event me-2 text-muted"></i>
                                    <small class="text-muted">Deadline: {{ $deadline->format('d M Y') }}</small>
                                </div>
                                @if($daysLeft < 0)
                                    <span class="badge bg-danger">
                                        <i class="bi bi-exclamation-circle me-1"></i> Terlewat
                                    </span>
                                @elseif($daysLeft == 0)
                                    <span class="badge bg-warning">
                                        <i class="bi bi-alarm me-1"></i> Hari Ini!
                                    </span>
                                @elseif($daysLeft <= 3)
                                    <span class="badge bg-warning">
                                        <i class="bi bi-clock me-1"></i> {{ $daysLeft }} hari lagi
                                    </span>
                                @else
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i> {{ $daysLeft }} hari lagi
                                    </span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <small class="text-muted d-block">
                                    <i class="bi bi-person me-1"></i> {{ $assignment->creator->name }}
                                </small>
                                <small class="text-muted">
                                    <i class="bi bi-clock me-1"></i> {{ $assignment->created_at->diffForHumans() }}
                                </small>
                            </div>

                            @if($assignment->file)
                            <div class="mb-3">
                                <span class="badge bg-primary">
                                    <i class="bi bi-paperclip me-1"></i> Ada File Lampiran
                                </span>
                            </div>
                            @endif

                            @if(auth()->user()->isSiswa())
                                @php
                                    $submission = $assignment->submissions->where('user_id', auth()->id())->first();
                                @endphp
                                @if($submission)
                                    <div class="alert alert-success mb-3 py-2">
                                        <small>
                                            <i class="bi bi-check-circle me-1"></i> 
                                            @if($submission->nilai !== null)
                                                Dinilai: <strong>{{ $submission->nilai }}</strong>
                                            @else
                                                Sudah dikumpulkan
                                            @endif
                                        </small>
                                    </div>
                                @endif
                            @endif

                            <div class="d-flex gap-2">
                                <a href="{{ route('assignments.show', $assignment->id) }}" class="btn btn-success flex-grow-1">
                                    <i class="bi bi-eye me-1"></i> Lihat
                                </a>
                                @if(auth()->user()->isGuru() && auth()->user()->id == $assignment->created_by)
                                <a href="{{ route('assignments.edit', $assignment->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $assignments->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-clipboard" style="font-size: 5rem; color: #e2e8f0;"></i>
                <h4 class="text-muted mt-3">Belum ada tugas</h4>
                @if(auth()->user()->isGuru())
                <p class="text-muted">Mulai berikan tugas untuk siswa</p>
                <a href="{{ route('assignments.create') }}" class="btn btn-success mt-3">
                    <i class="bi bi-plus-circle me-2"></i> Tambah Tugas
                </a>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection
