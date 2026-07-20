# Website Pembelajaran Agama Hindu

Website pembelajaran agama Hindu untuk siswa SD dan SMP dengan fitur lengkap pembelajaran, tugas, absensi, dan penilaian.

## 🎯 Fitur Utama

### Untuk Siswa
- ✅ Login dan registrasi dengan role siswa
- 📚 Melihat materi pembelajaran
- 📝 Mengerjakan dan mengumpulkan tugas
- 📅 Melakukan absensi harian
- 💯 Melihat nilai tugas yang sudah dinilai
- 📊 Dashboard siswa dengan info pembelajaran terbaru

### Untuk Guru
- ✅ Login dan registrasi dengan role guru
- ➕ Menambah, mengedit, dan menghapus materi pembelajaran
- 📋 Membuat dan mengelola tugas
- ✏️ Menilai tugas siswa dengan feedback
- 👥 Melihat daftar absensi siswa
- 📈 Laporan absensi dengan filter periode
- 📊 Dashboard guru dengan statistik lengkap

## 🚀 Teknologi

- **Framework**: Laravel 11
- **Database**: MySQL
- **Frontend**: Bootstrap 5 + Custom CSS
- **Icons**: Bootstrap Icons
- **PHP**: 8.3+

## 📋 Persyaratan Sistem

- PHP >= 8.3
- Composer
- MySQL
- Extension PHP yang diperlukan:
  - pdo_mysql
  - mbstring
  - openssl
  - fileinfo

## ⚙️ Instalasi

### 1. Enable MySQL Extension di PHP

Buka file `php.ini` (lokasi di Laragon biasanya: `C:\laragon\bin\php\php-8.3.x\php.ini`)

Cari dan hapus tanda `;` (uncomment) pada baris:
```ini
;extension=pdo_mysql
;extension=mysqli
```

Menjadi:
```ini
extension=pdo_mysql
extension=mysqli
```

Restart Laragon/Apache setelah mengubah php.ini

### 2. Buat Database

Buka MySQL melalui Laragon atau phpMyAdmin, kemudian jalankan:
```sql
CREATE DATABASE pembelajaran_hindu CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 3. Konfigurasi Environment

File `.env` sudah dikonfigurasi dengan:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pembelajaran_hindu
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan `DB_PASSWORD` jika MySQL Anda menggunakan password.

### 4. Jalankan Migrasi dan Seeder

```bash
cd E:\app\Coding\laragon\www\HinduApp\pembelajaran-hindu
php artisan migrate:fresh --seed
```

### 5. Jalankan Aplikasi

```bash
php artisan serve
```

Atau buka melalui Laragon: `http://pembelajaran-hindu.test`

## 👤 Akun Default (Setelah Seeder)

### Guru
- **Email**: guru@hindu.com
- **Password**: password

- **Email**: made@hindu.com
- **Password**: password

### Siswa
- **Email**: ayu@siswa.com
- **Password**: password
- **Kelas**: 4 SD

- **Email**: wayan@siswa.com
- **Password**: password
- **Kelas**: 5 SD

- **Email**: dewi@siswa.com
- **Password**: password
- **Kelas**: 6 SD

- **Email**: adi@siswa.com
- **Password**: password
- **Kelas**: 7 SMP

- **Email**: purnama@siswa.com
- **Password**: password
- **Kelas**: 8 SMP

## 📁 Struktur Folder Penting

```
pembelajaran-hindu/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── LessonController.php
│   │   │   ├── AssignmentController.php
│   │   │   ├── AssignmentSubmissionController.php
│   │   │   └── AttendanceController.php
│   │   └── Middleware/
│   │       └── RoleMiddleware.php
│   └── Models/
│       ├── User.php
│       ├── Lesson.php
│       ├── Assignment.php
│       ├── AssignmentSubmission.php
│       └── Attendance.php
├── database/
│   ├── migrations/
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── layouts/
│       │   └── app.blade.php
│       ├── dashboard/
│       │   ├── guru.blade.php
│       │   └── siswa.blade.php
│       ├── lessons/
│       ├── assignments/
│       └── attendances/
├── routes/
│   └── web.php
└── storage/
    └── app/
        └── public/
            ├── lessons/
            ├── assignments/
            └── submissions/
```

## 🎨 Fitur UI/UX

- ✨ Desain modern dengan gradien warna ungu
- 📱 Responsive untuk semua ukuran layar
- 🎯 Navigasi sidebar yang mudah digunakan
- 💫 Animasi hover yang smooth
- 🌈 Badge status berwarna untuk info cepat
- 🔔 Alert notification untuk feedback user

## 📝 Cara Penggunaan

### Sebagai Guru

1. **Login** dengan akun guru
2. **Dashboard** menampilkan statistik pembelajaran, tugas, dan siswa
3. **Tambah Pembelajaran**:
   - Klik menu "Pembelajaran" > "Tambah Pembelajaran"
   - Isi form (judul, tingkat, kelas, deskripsi, konten)
   - Upload file lampiran (opsional)
   - Klik "Simpan"
4. **Tambah Tugas**:
   - Klik menu "Tugas" > "Tambah Tugas"
   - Isi detail tugas dan deadline
   - Upload file soal (opsional)
5. **Nilai Tugas**:
   - Buka detail tugas
   - Klik "Lihat & Nilai" pada pengumpulan siswa
   - Beri nilai (0-100) dan feedback
6. **Lihat Absensi**:
   - Menu "Absensi" menampilkan absen hari ini
   - Menu "Laporan Absen" untuk rekap periode

### Sebagai Siswa

1. **Login** dengan akun siswa
2. **Dashboard** menampilkan pembelajaran dan tugas terbaru
3. **Absen Harian**:
   - Klik "Absen Sekarang" di dashboard
   - Pilih status kehadiran (Hadir/Izin/Sakit/Alpha)
   - Isi keterangan jika perlu
4. **Baca Pembelajaran**:
   - Menu "Pembelajaran" untuk lihat semua materi
   - Klik "Lihat" untuk baca detail
   - Download file lampiran jika ada
5. **Kerjakan Tugas**:
   - Menu "Tugas" untuk lihat daftar tugas
   - Klik "Lihat" pada tugas
   - Tulis jawaban dan upload file (opsional)
   - Klik "Kumpulkan Tugas"
6. **Lihat Nilai**:
   - Buka tugas yang sudah dikumpulkan
   - Nilai dan feedback akan muncul setelah guru menilai

## 🔒 Security Features

- Password hashing dengan bcrypt
- Middleware authentication
- Role-based access control
- CSRF protection
- Input validation
- File upload validation

## 📦 Package yang Digunakan

Semua package sudah terinstall via Laravel 11:
- Laravel Framework 11.x
- Laravel UI Components
- Storage untuk file upload
- Pagination

## 🐛 Troubleshooting

### Error: could not find driver

**Solusi**: Enable extension `pdo_mysql` di `php.ini` dan restart server

### Error: Access denied for user

**Solusi**: Cek username dan password MySQL di file `.env`

### Error: Base table or column not found

**Solusi**: Jalankan `php artisan migrate:fresh --seed`

### File upload tidak berfungsi

**Solusi**: Jalankan `php artisan storage:link`

### Styling tidak muncul

**Solusi**: Clear browser cache atau hard refresh (Ctrl + F5)

## 📞 Support

Jika ada pertanyaan atau kendala, silakan hubungi developer atau buat issue di repository.

## 📄 License

Project ini dibuat untuk keperluan pembelajaran.

---

**Dibuat dengan ❤️ untuk Pendidikan Agama Hindu**
