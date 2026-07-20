@extends('layouts.app')

@section('title', 'Daftar Pembelajaran')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-white">
            <i class="bi bi-book me-2"></i> Daftar Pembelajaran
        </h2>
        <p class="text-white opacity-75">Kelola materi pembelajaran agama Hindu</p>
    </div>
    @if(auth()->user()->isGuru())
    <a href="{{ route('lessons.create') }}" class="btn btn-light btn-lg">
        <i class="bi bi-plus-circle me-2"></i> Tambah Pembelajaran
    </a>
    @endif
</div>

<div class="card">
    <div class="card-body">
        @if($lessons->count() > 0)
            <div class="row">
                @foreach($lessons as $lesson)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-book-half text-white" style="font-size: 2rem;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fw-bold mb-1">{{ $lesson->judul }}</h5>
                                    <div>
                                        <span class="badge bg-primary">{{ $lesson->tingkat }}</span>
                                        <span class="badge bg-info">{{ $lesson->kelas }}</span>
                                    </div>
                                </div>
                            </div>

                            <p class="text-muted mb-3 flex-grow-1">{{ Str::limit($lesson->deskripsi, 120) }}</p>

                            <div class="mb-3">
                                <small class="text-muted d-block">
                                    <i class="bi bi-person me-1"></i> {{ $lesson->creator->name }}
                                </small>
                                <small class="text-muted">
                                    <i class="bi bi-clock me-1"></i> {{ $lesson->created_at->diffForHumans() }}
                                </small>
                            </div>

                            @if($lesson->file)
                            <div class="mb-3">
                                <span class="badge bg-success">
                                    <i class="bi bi-paperclip me-1"></i> Ada File Lampiran
                                </span>
                            </div>
                            @endif

                            <div class="d-flex gap-2">
                                <a href="{{ route('lessons.show', $lesson->id) }}" class="btn btn-primary flex-grow-1">
                                    <i class="bi bi-eye me-1"></i> Lihat
                                </a>
                                @if(auth()->user()->isGuru() && auth()->user()->id == $lesson->created_by)
                                <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pembelajaran ini?')">
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
                {{ $lessons->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-book" style="font-size: 5rem; color: #e2e8f0;"></i>
                <h4 class="text-muted mt-3">Belum ada pembelajaran</h4>
                @if(auth()->user()->isGuru())
                <p class="text-muted">Mulai tambahkan materi pembelajaran untuk siswa</p>
                <a href="{{ route('lessons.create') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-circle me-2"></i> Tambah Pembelajaran
                </a>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection
