<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Pembelajaran Hindu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-container {
            background: white;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 1100px;
            width: 100%;
            margin: 30px 0;
        }

        .register-left {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .register-left h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .register-left p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .register-left i {
            font-size: 5rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .register-right {
            padding: 60px 40px;
        }

        .register-right h2 {
            color: #667eea;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .register-right p {
            color: #6b7280;
            margin-bottom: 30px;
        }

        .form-control, .form-select {
            border-radius: 15px;
            border: 2px solid #e2e8f0;
            padding: 15px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .input-group-text {
            background: transparent;
            border: 2px solid #e2e8f0;
            border-right: none;
            border-radius: 15px 0 0 15px;
            color: #667eea;
        }

        .input-group .form-control, .input-group .form-select {
            border-left: none;
            border-radius: 0 15px 15px 0;
        }

        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 15px;
            padding: 15px;
            font-weight: 600;
            font-size: 1.1rem;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #6b7280;
        }

        .login-link a {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .role-cards {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .role-card {
            flex: 1;
            border: 3px solid #e2e8f0;
            border-radius: 15px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .role-card:hover {
            border-color: #667eea;
        }

        .role-card.active {
            border-color: #667eea;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        }

        .role-card i {
            font-size: 2.5rem;
            color: #667eea;
            margin-bottom: 10px;
        }

        .role-card .role-title {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 5px;
        }

        .role-card .role-desc {
            font-size: 0.85rem;
            color: #6b7280;
        }

        #siswaFields {
            display: none;
        }

        @media (max-width: 768px) {
            .register-left {
                display: none;
            }
            .role-cards {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="row g-0">
            <div class="col-md-5">
                <div class="register-left">
                    <i class="bi bi-person-plus-fill"></i>
                    <h1>Bergabunglah!</h1>
                    <p>Daftar sekarang dan mulai perjalanan belajar agama Hindu Anda</p>
                    <p class="mt-4">
                        <i class="bi bi-check-circle me-2"></i> Akses Materi Lengkap<br>
                        <i class="bi bi-check-circle me-2"></i> Tugas Interaktif<br>
                        <i class="bi bi-check-circle me-2"></i> Absensi Online<br>
                        <i class="bi bi-check-circle me-2"></i> Pantau Perkembangan
                    </p>
                </div>
            </div>
            <div class="col-md-7">
                <div class="register-right">
                    <h2>Daftar Akun</h2>
                    <p>Lengkapi form berikut untuk membuat akun</p>

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST" id="registerForm">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Daftar Sebagai</label>
                            <div class="role-cards">
                                <div class="role-card" onclick="selectRole('siswa')">
                                    <i class="bi bi-person"></i>
                                    <div class="role-title">Siswa</div>
                                    <div class="role-desc">Untuk siswa SD & SMP</div>
                                </div>
                                <div class="role-card" onclick="selectRole('guru')">
                                    <i class="bi bi-person-workspace"></i>
                                    <div class="role-title">Guru</div>
                                    <div class="role-desc">Untuk pengajar</div>
                                </div>
                            </div>
                            <input type="hidden" name="role" id="roleInput" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-person-circle"></i>
                                </span>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                       placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                            </div>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                       placeholder="Masukkan email" value="{{ old('email') }}" required>
                            </div>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div id="siswaFields">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Kelas</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-building"></i>
                                    </span>
                                    <select name="kelas" class="form-select @error('kelas') is-invalid @enderror">
                                        <option value="">Pilih Kelas</option>
                                        <option value="1 SD">1 SD</option>
                                        <option value="2 SD">2 SD</option>
                                        <option value="3 SD">3 SD</option>
                                        <option value="4 SD">4 SD</option>
                                        <option value="5 SD">5 SD</option>
                                        <option value="6 SD">6 SD</option>
                                        <option value="7 SMP">7 SMP</option>
                                        <option value="8 SMP">8 SMP</option>
                                        <option value="9 SMP">9 SMP</option>
                                    </select>
                                </div>
                                @error('kelas')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Nomor Induk</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-card-text"></i>
                                    </span>
                                    <input type="text" name="no_induk" class="form-control @error('no_induk') is-invalid @enderror" 
                                           placeholder="Masukkan nomor induk siswa" value="{{ old('no_induk') }}">
                                </div>
                                @error('no_induk')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                       placeholder="Masukkan password (min. 8 karakter)" required>
                            </div>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Konfirmasi Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input type="password" name="password_confirmation" class="form-control" 
                                       placeholder="Ulangi password" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-register">
                            <i class="bi bi-person-plus me-2"></i> Daftar Sekarang
                        </button>
                    </form>

                    <div class="login-link">
                        Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function selectRole(role) {
            // Remove active class from all cards
            document.querySelectorAll('.role-card').forEach(card => {
                card.classList.remove('active');
            });
            
            // Add active class to selected card
            event.currentTarget.classList.add('active');
            
            // Set hidden input value
            document.getElementById('roleInput').value = role;
            
            // Show/hide siswa fields
            if (role === 'siswa') {
                document.getElementById('siswaFields').style.display = 'block';
            } else {
                document.getElementById('siswaFields').style.display = 'none';
            }
        }

        // Restore role selection on page load if old input exists
        document.addEventListener('DOMContentLoaded', function() {
            const oldRole = "{{ old('role') }}";
            if (oldRole) {
                selectRole(oldRole);
                document.querySelector(`.role-card:nth-child(${oldRole === 'siswa' ? 1 : 2})`).classList.add('active');
            }
        });
    </script>
</body>
</html>
