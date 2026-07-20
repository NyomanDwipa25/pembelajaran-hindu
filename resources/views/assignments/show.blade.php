@extends('layouts.app')

@section('title', $assignment->judul)

@section('content')
<div class="mb-4">
    <a href="{{ route('assignments.index') }}" class="btn btn-light mb-3">
        <i class="bi bi-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-1"><i class="bi bi-clipboard-check me-2"></i> {{ $assignment->judul }}</h4>
                    <div>
                        <span class="badge bg-success">{{ $assignment->tingkat }}</span>
                        <span class="badge bg-info">{{ $assignment->kelas }}</span>
                    </div>
                </div>
                @if(auth()->user()->isGuru() && auth()->user()->id == $assignment->created_by)
                <div>
                    <a href="{{ route('assignments.edit', $assignment->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                </div>
                @endif
            </div>
            <div class="card-body">
                <!-- Info Section -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center p-3" style="background: #f8f9fa; border-radius: 15px;">
                            <div class="me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-person text-white" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Dibuat oleh</small>
                                <strong>{{ $assignment->creator->name }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center p-3" style="background: #f8f9fa; border-radius: 15px;">
                            <div class="me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-calendar-event text-white" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Deadline</small>
                                <strong>{{ $assignment->tanggal_deadline->format('d M Y') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-card-text me-2"></i> Deskripsi Tugas
                    </h5>
                    <div class="content-box p-4" style="background: #f8f9fa; border-radius: 15px; line-height: 1.8;">
                        {!! nl2br(e($assignment->deskripsi)) !!}
                    </div>
                </div>

                <!-- File Attachment -->
                @if($assignment->file)
                <div class="mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-paperclip me-2"></i> File Lampiran
                    </h5>
                    <div class="d-flex align-items-center p-3" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%); border-radius: 15px;">
                        <div class="me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-file-earmark-text text-white" style="font-size: 1.5rem;"></i>
                        </div>
                        <div class="flex-grow-1">
                            <strong class="d-block">{{ basename($assignment->file) }}</strong>
                            <small class="text-muted">Klik untuk mengunduh</small>
                        </div>
                        <a href="{{ route('files.download', $assignment->file) }}" class="btn btn-primary">
                            <i class="bi bi-download me-1"></i> Unduh
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Submission Form for Students -->
        @if(auth()->user()->isSiswa())
        <div class="card">
            <div class="card-header">
                <i class="bi bi-send me-2"></i> Kumpulkan Tugas
            </div>
            <div class="card-body">
                @if($userSubmission)
                    <div class="alert alert-success">
                        <h5><i class="bi bi-check-circle me-2"></i> Tugas Sudah Dikumpulkan</h5>
                        <p class="mb-2">Dikumpulkan pada: <strong>{{ $userSubmission->submitted_at->format('d M Y, H:i') }}</strong></p>
                        @if($userSubmission->nilai !== null)
                            <div class="mt-3 p-3" style="background: white; border-radius: 10px;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">Nilai Anda:</span>
                                    <span class="badge bg-primary" style="font-size: 1.2rem; padding: 10px 20px;">{{ $userSubmission->nilai }}</span>
                                </div>
                                @if($userSubmission->feedback)
                                <div class="mt-3">
                                    <strong>Feedback dari Guru:</strong>
                                    <p class="mb-0 mt-2">{{ $userSubmission->feedback }}</p>
                                </div>
                                @endif
                            </div>
                        @else
                            <p class="mb-0 mt-2"><i class="bi bi-clock me-1"></i> Menunggu penilaian dari guru</p>
                        @endif
                    </div>

                    <div class="p-3" style="background: #f8f9fa; border-radius: 15px;">
                        <h6 class="fw-bold mb-2">Jawaban Anda:</h6>
                        <p class="mb-2">{{ $userSubmission->jawaban }}</p>
                        @if($userSubmission->file)
                            <a href="{{ route('files.download', $userSubmission->file) }}" class="btn btn-sm btn-primary mt-2">
                                <i class="bi bi-download me-1"></i> Lihat File yang Dikumpulkan
                            </a>
                        @endif
                    </div>
                @else
                    <form action="{{ route('assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Jawaban Anda <span class="text-danger">*</span></label>
                            <textarea name="jawaban" rows="6" class="form-control @error('jawaban') is-invalid @enderror" 
                                      placeholder="Tulis jawaban Anda di sini..." required>{{ old('jawaban') }}</textarea>
                            @error('jawaban')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">File Jawaban (Opsional)</label>
                            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" 
                                   accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i> Format: PDF, DOC, DOCX, JPG, PNG (Max: 10MB)
                            </small>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg w-100">
                            <i class="bi bi-send me-2"></i> Kumpulkan Tugas
                        </button>
                    </form>
                @endif
            </div>
        </div>
        @endif
    </div>

    <!-- Submissions List for Teachers -->
    @if(auth()->user()->isGuru() && auth()->user()->id == $assignment->created_by)
    <div class="col-lg-4">
        <div class="card sticky-top" style="top: 90px;">
            <div class="card-header">
                <i class="bi bi-people me-2"></i> Pengumpulan Tugas ({{ $assignment->submissions->count() }})
            </div>
            <div class="card-body" style="max-height: 600px; overflow-y: auto;">
                @if($assignment->submissions->count() > 0)
                    @foreach($assignment->submissions as $submission)
                    <div class="mb-3 p-3" style="background: #f8f9fa; border-radius: 15px;">
                        <div class="d-flex align-items-start mb-2">
                            <div class="me-2" style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                {{ strtoupper(substr($submission->user->name, 0, 1)) }}
                            </div>
                            <div class="flex-grow-1">
                                <strong class="d-block">{{ $submission->user->name }}</strong>
                                <small class="text-muted">{{ $submission->user->kelas }}</small>
                            </div>
                        </div>
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-clock me-1"></i> {{ $submission->submitted_at->format('d M Y, H:i') }}
                        </small>
                        
                        @if($submission->nilai !== null)
                            <span class="badge bg-success mb-2">
                                <i class="bi bi-check-circle me-1"></i> Nilai: {{ $submission->nilai }}
                            </span>
                        @else
                            <span class="badge bg-warning mb-2">
                                <i class="bi bi-clock me-1"></i> Belum dinilai
                            </span>
                        @endif

                        <button type="button" class="btn btn-sm btn-primary w-100 mt-2" data-bs-toggle="modal" data-bs-target="#gradeModal{{ $submission->id }}">
                            <i class="bi bi-eye me-1"></i> Lihat & Nilai
                        </button>
                    </div>
                    @endforeach
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-inbox" style="font-size: 3rem; color: #e2e8f0;"></i>
                        <p class="text-muted mt-2 mb-0">Belum ada pengumpulan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>

<!-- All Modals (outside scroll container for proper positioning) -->
@if(auth()->user()->isGuru() && auth()->user()->id == $assignment->created_by)
    @foreach($assignment->submissions as $submission)
    <div class="modal fade" id="gradeModal{{ $submission->id }}" data-bs-backdrop="false" data-bs-keyboard="true" tabindex="-1" aria-labelledby="gradeModalLabel{{ $submission->id }}" aria-hidden="true" style="position: fixed;">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-person-circle me-2"></i> {{ $submission->user->name }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <strong>Jawaban:</strong>
                        <div class="p-3 mt-2" style="background: #f8f9fa; border-radius: 10px;">
                            {{ $submission->jawaban }}
                        </div>
                    </div>

                    @if($submission->file)
                    <div class="mb-3">
                        <strong>File:</strong>
                        <div class="mt-2">
                            <a href="{{ route('files.download', $submission->file) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-download me-1"></i> Unduh File
                            </a>
                        </div>
                    </div>
                    @endif

                    <hr>

                    <form action="{{ route('submissions.grade', $submission->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nilai (0-100)</label>
                            <input type="number" name="nilai" class="form-control" min="0" max="100" 
                                   value="{{ $submission->nilai }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Feedback (Opsional)</label>
                            <textarea name="feedback" rows="3" class="form-control" 
                                      placeholder="Berikan feedback untuk siswa...">{{ $submission->feedback }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-check-circle me-2"></i> Simpan Nilai
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endif

@push('scripts')
<script>
    // Simple modal handler - no backdrop needed
    document.addEventListener('DOMContentLoaded', function() {
        
        // Function to reset body state
        function resetBodyState() {
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
            
            // Remove any leftover backdrops (just in case)
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
        }
        
        // Reset on page load
        resetBodyState();
        
        // Handle all modals
        const modals = document.querySelectorAll('.modal');
        
        modals.forEach(function(modal) {
            // When modal is hidden, reset body
            modal.addEventListener('hidden.bs.modal', function () {
                resetBodyState();
            });
        });
        
        // Handle close buttons
        document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(function(button) {
            button.addEventListener('click', function() {
                resetBodyState();
            });
        });
        
        // Handle ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const openModal = document.querySelector('.modal.show');
                if (openModal) {
                    const bsModal = bootstrap.Modal.getInstance(openModal);
                    if (bsModal) {
                        bsModal.hide();
                    }
                }
                resetBodyState();
            }
        });
        
        // Safety cleanup every 2 seconds
        setInterval(resetBodyState, 2000);
    });
</script>
@endpush
@endsection
