@extends('layouts.app')

@section('title', $lesson->judul)

@section('content')
<div class="mb-4">
    <a href="{{ route('lessons.index') }}" class="btn btn-light mb-3">
        <i class="bi bi-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-1"><i class="bi bi-book-half me-2"></i> {{ $lesson->judul }}</h4>
                    <div>
                        <span class="badge bg-primary">{{ $lesson->tingkat }}</span>
                        <span class="badge bg-info">{{ $lesson->kelas }}</span>
                    </div>
                </div>
                @if(auth()->user()->isGuru() && auth()->user()->id == $lesson->created_by)
                <div>
                    <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                </div>
                @endif
            </div>
            <div class="card-body">
                <!-- Info Section -->
                <div class="d-flex align-items-center mb-4 p-3" style="background: #f8f9fa; border-radius: 15px;">
                    <div class="me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-person text-white" style="font-size: 1.5rem;"></i>
                    </div>
                    <div class="flex-grow-1">
                        <small class="text-muted d-block">Dibuat oleh</small>
                        <strong>{{ $lesson->creator->name }}</strong>
                    </div>
                    <div class="text-end">
                        <small class="text-muted d-block">Tanggal</small>
                        <strong>{{ $lesson->created_at->format('d M Y') }}</strong>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-card-text me-2"></i> Deskripsi
                    </h5>
                    <p class="text-muted">{{ $lesson->deskripsi }}</p>
                </div>

                <!-- Content -->
                <div class="mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-journal-text me-2"></i> Materi Pembelajaran
                    </h5>
                    <div class="content-box p-4" style="background: #f8f9fa; border-radius: 15px; line-height: 1.8;">
                        {!! nl2br(e($lesson->konten)) !!}
                    </div>
                </div>

                <!-- File Attachment -->
                @if($lesson->file)
                <div class="mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-paperclip me-2"></i> File Lampiran
                    </h5>
                    <div class="d-flex align-items-center p-3" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%); border-radius: 15px;">
                        <div class="me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-file-earmark-text text-white" style="font-size: 1.5rem;"></i>
                        </div>
                        <div class="flex-grow-1">
                            <strong class="d-block">{{ basename($lesson->file) }}</strong>
                            <small class="text-muted">Klik untuk mengunduh</small>
                        </div>
                        <a href="{{ route('files.download', $lesson->file) }}" onclick="forceDownload(event, '{{ route('files.download', $lesson->file) }}', '{{ basename($lesson->file) }}')" class="btn btn-primary">
                            <i class="bi bi-download me-1"></i> Unduh
                        </a>
                    </div>
                </div>
                @endif

                <!-- Action Buttons for Students -->
                @if(auth()->user()->isSiswa())
                <div class="text-center mt-5">
                    <div class="p-4" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%); border-radius: 20px;">
                        <i class="bi bi-check-circle" style="font-size: 3rem; color: #10b981;"></i>
                        <h5 class="fw-bold mt-3 mb-2">Selamat Belajar! 📚</h5>
                        <p class="text-muted mb-0">Pahami materi dengan baik dan jangan lupa kerjakan tugas yang diberikan</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
