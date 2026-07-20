# 🕉️ INSTRUKSI SETUP - Website Pembelajaran Hindu

## ✅ Status: Folder sudah dipindahkan ke E:\app\Coding\laragon\www\pembelajaran-hindu

---

## 📋 LANGKAH SETUP (WAJIB DIIKUTI)

### STEP 1: Enable Extension MySQL di PHP

1. Buka file `php.ini` di Laragon
   - Lokasi: `C:\laragon\bin\php\php-8.3.x\php.ini`
   - Atau klik kanan icon Laragon > PHP > php.ini

2. Cari baris berikut (gunakan Ctrl+F):
   ```ini
   ;extension=pdo_mysql
   ;extension=mysqli
   ```

3. Hapus tanda `;` di depannya menjadi:
   ```ini
   extension=pdo_mysql
   extension=mysqli
   ```

4. **Save file** dan **Restart Laragon** (Stop All > Start All)

---

### STEP 2: Buat Database MySQL

1. Buka HeidiSQL atau phpMyAdmin di Laragon
2. Jalankan query berikut:
   ```sql
   CREATE DATABASE pembelajaran_hindu CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
   
   ATAU klik kanan di HeidiSQL > Create new > Database > nama: `pembelajaran_hindu`

---

### STEP 3: Jalankan Migrasi dan Seeder

Buka **Command Prompt** atau **Terminal**, kemudian:

```bash
cd E:\app\Coding\laragon\www\pembelajaran-hindu

php artisan migrate:fresh --seed
```

**Tunggu sampai selesai!** Proses ini akan:
- Membuat tabel-tabel database
- Mengisi data dummy (guru, siswa, pembelajaran, tugas, absensi)

---

### STEP 4: Jalankan Aplikasi

**Pilihan A - Menggunakan PHP Artisan Serve:**
```bash
php artisan serve
```
Buka browser: `http://localhost:8000`

**Pilihan B - Menggunakan Laragon (Recommended):**
1. Pastikan Laragon sudah running
2. Buka browser: `http://pembelajaran-hindu.test`

---

## 👥 AKUN LOGIN (Setelah Seeder Berhasil)

### 🧑‍🏫 GURU

**Akun 1:**
- Email: `guru@hindu.com`
- Password: `password`

**Akun 2:**
- Email: `made@hindu.com`
- Password: `password`

### 👨‍🎓 SISWA

**Siswa SD - Kelas 4:**
- Email: `ayu@siswa.com`
- Password: `password`

**Siswa SD - Kelas 5:**
- Email: `wayan@siswa.com`
- Password: `password`

**Siswa SD - Kelas 6:**
- Email: `dewi@siswa.com`
- Password: `password`

**Siswa SMP - Kelas 7:**
- Email: `adi@siswa.com`
- Password: `password`

**Siswa SMP - Kelas 8:**
- Email: `purnama@siswa.com`
- Password: `password`

---

## 🎯 FITUR REGISTRASI AKUN BARU

### ✅ Registrasi untuk Siswa dan Guru SUDAH TERSEDIA!

**Cara Registrasi:**

1. Buka halaman login: `http://pembelajaran-hindu.test` atau `http://localhost:8000`
2. Klik link **"Daftar sekarang"** di bawah form login
3. Pilih role: **Siswa** atau **Guru**
4. Isi form registrasi:

**Untuk SISWA:**
- Nama Lengkap
- Email
- Kelas (1-6 SD atau 7-9 SMP)
- Nomor Induk
- Password (min 8 karakter)
- Konfirmasi Password

**Untuk GURU:**
- Nama Lengkap
- Email
- Password (min 8 karakter)
- Konfirmasi Password

5. Klik **"Daftar Sekarang"**
6. Otomatis login dan masuk ke dashboard

---

## 📚 FITUR LENGKAP APLIKASI

### 👨‍🎓 Fitur untuk SISWA:
✅ Registrasi akun sendiri
✅ Login dengan email dan password
✅ Dashboard dengan info pembelajaran & tugas terbaru
✅ Lihat dan baca materi pembelajaran
✅ Download file pembelajaran
✅ Lihat daftar tugas dengan status deadline
✅ Kerjakan dan kumpulkan tugas
✅ Upload file jawaban tugas
✅ Lihat nilai dan feedback dari guru
✅ Absensi harian (Hadir/Izin/Sakit/Alpha)
✅ Riwayat absensi pribadi

### 🧑‍🏫 Fitur untuk GURU:
✅ Registrasi akun sendiri
✅ Login dengan email dan password
✅ Dashboard dengan statistik lengkap
✅ Tambah, edit, hapus materi pembelajaran
✅ Upload file pembelajaran (PDF, DOC, PPT)
✅ Buat dan kelola tugas untuk siswa
✅ Set deadline tugas
✅ Lihat semua pengumpulan tugas
✅ Beri nilai (0-100) dan feedback untuk tugas
✅ Lihat daftar absensi siswa hari ini
✅ Lihat semua siswa dan status absennya
✅ Laporan absensi dengan filter periode
✅ Cetak laporan absensi

---

## 🎨 DESAIN UI/UX

✨ Desain modern dengan warna gradien ungu-pink
📱 Responsive untuk HP, Tablet, dan Desktop
🎯 Navigasi sidebar yang mudah
💫 Animasi smooth saat hover
🌈 Badge berwarna untuk status
📊 Dashboard dengan card statistik
📋 Tabel data yang rapi
🔔 Alert notification untuk feedback

---

## 🐛 TROUBLESHOOTING

### ❌ Error: "could not find driver"
**Solusi:** 
- Enable extension `pdo_mysql` di php.ini (lihat STEP 1)
- Restart Laragon
- Coba lagi: `php artisan migrate:fresh --seed`

### ❌ Error: "Access denied for user 'root'"
**Solusi:**
- Buka file `.env` di root project
- Cek baris `DB_PASSWORD=`
- Jika MySQL ada password, isi passwordnya
- Jika tidak ada password, biarkan kosong

### ❌ Error: "Base table or view not found"
**Solusi:**
```bash
php artisan migrate:fresh --seed
```

### ❌ File upload tidak berfungsi
**Solusi:**
```bash
php artisan storage:link
```

### ❌ Halaman blank/putih
**Solusi:**
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### ❌ Styling tidak muncul
**Solusi:**
- Hard refresh browser: `Ctrl + Shift + R` atau `Ctrl + F5`
- Clear browser cache

---

## 📂 STRUKTUR DATABASE

**Tabel yang dibuat:**

1. **users** - Data guru dan siswa
2. **lessons** - Materi pembelajaran
3. **assignments** - Tugas untuk siswa
4. **assignment_submissions** - Pengumpulan tugas
5. **attendances** - Data absensi
6. **cache** - Cache system
7. **jobs** - Queue jobs
8. **sessions** - User sessions

---

## 🔐 KEAMANAN

✅ Password di-hash dengan bcrypt
✅ CSRF Protection
✅ Role-based Access Control (Guru & Siswa)
✅ Input validation
✅ File upload validation
✅ SQL Injection protection
✅ XSS protection

---

## 📞 TESTING APLIKASI

### Test Scenario 1: Registrasi dan Login
1. Buka halaman registrasi
2. Daftar sebagai siswa dengan kelas 5 SD
3. Akan otomatis login ke dashboard siswa
4. Logout
5. Login kembali dengan email dan password yang tadi

### Test Scenario 2: Flow Guru
1. Login sebagai guru (`guru@hindu.com` / `password`)
2. Buat pembelajaran baru dengan file PDF
3. Buat tugas baru dengan deadline 7 hari
4. Lihat daftar absensi hari ini
5. Cek laporan absensi bulan ini

### Test Scenario 3: Flow Siswa
1. Login sebagai siswa (`ayu@siswa.com` / `password`)
2. Absen dengan status "Hadir"
3. Baca materi pembelajaran
4. Download file pembelajaran
5. Kerjakan tugas dan upload jawaban
6. Lihat nilai setelah guru menilai

### Test Scenario 4: Interaksi Guru-Siswa
1. Siswa kumpulkan tugas (login sebagai siswa)
2. Guru beri nilai 85 dengan feedback (login sebagai guru)
3. Siswa lihat nilai dan feedback (login sebagai siswa)

---

## 📊 DATA DUMMY (Setelah Seeder)

**Guru:** 2 akun
**Siswa:** 5 akun (3 SD, 2 SMP)
**Pembelajaran:** 3 materi
**Tugas:** 3 tugas
**Absensi:** 4 data hari ini
**Pengumpulan Tugas:** 1 sudah dinilai

---

## ✅ CHECKLIST SEBELUM TESTING

- [ ] Extension MySQL sudah enabled di php.ini
- [ ] Laragon sudah di-restart
- [ ] Database `pembelajaran_hindu` sudah dibuat
- [ ] Migration dan seeder sudah dijalankan tanpa error
- [ ] Storage link sudah dibuat
- [ ] Aplikasi bisa dibuka di browser
- [ ] Bisa login dengan akun dummy
- [ ] Dashboard tampil dengan benar

---

## 🎉 SELAMAT!

Jika semua langkah sudah diikuti, aplikasi siap digunakan!

**Login pertama:** 
- Guru: `guru@hindu.com` / `password`
- Siswa: `ayu@siswa.com` / `password`

**Atau buat akun baru melalui halaman registrasi!**

---

**Dibuat dengan ❤️ untuk Pendidikan Agama Hindu**
