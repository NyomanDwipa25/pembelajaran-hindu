<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Lesson;
use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\AssignmentSubmission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Guru
        $guru1 = User::create([
            'name' => 'Ibu Ketut Sari',
            'email' => 'guru@hindu.com',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'kelas' => null,
            'no_induk' => null,
        ]);

        $guru2 = User::create([
            'name' => 'Pak Made Wirawan',
            'email' => 'made@hindu.com',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'kelas' => null,
            'no_induk' => null,
        ]);

        // Create Siswa SD
        $siswa1 = User::create([
            'name' => 'Kadek Ayu Lestari',
            'email' => 'ayu@siswa.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'kelas' => '4 SD',
            'no_induk' => '2023001',
        ]);

        $siswa2 = User::create([
            'name' => 'Wayan Putra Mahendra',
            'email' => 'wayan@siswa.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'kelas' => '5 SD',
            'no_induk' => '2023002',
        ]);

        $siswa3 = User::create([
            'name' => 'Komang Dewi Sartika',
            'email' => 'dewi@siswa.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'kelas' => '6 SD',
            'no_induk' => '2023003',
        ]);

        // Create Siswa SMP
        $siswa4 = User::create([
            'name' => 'Nyoman Adi Saputra',
            'email' => 'adi@siswa.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'kelas' => '7 SMP',
            'no_induk' => '2023004',
        ]);

        $siswa5 = User::create([
            'name' => 'Ketut Ayu Purnama',
            'email' => 'purnama@siswa.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'kelas' => '8 SMP',
            'no_induk' => '2023005',
        ]);

        // Create Lessons
        $lesson1 = Lesson::create([
            'judul' => 'Pengenalan Agama Hindu',
            'deskripsi' => 'Materi pengenalan dasar tentang agama Hindu dan sejarahnya',
            'konten' => "Agama Hindu adalah salah satu agama tertua di dunia. Hindu memiliki kitab suci bernama Weda yang berisi ajaran-ajaran luhur.\n\nDalam agama Hindu, terdapat konsep Tri Murti yaitu:\n1. Brahma - Pencipta\n2. Wisnu - Pemelihara\n3. Siwa - Pelebur\n\nAgama Hindu juga mengajarkan tentang Dharma (kebenaran), Karma (perbuatan), dan Moksa (pembebasan).",
            'tingkat' => 'SD',
            'kelas' => '4 SD',
            'created_by' => $guru1->id,
        ]);

        $lesson2 = Lesson::create([
            'judul' => 'Kitab Suci Weda',
            'deskripsi' => 'Mempelajari tentang kitab suci Weda dan bagian-bagiannya',
            'konten' => "Weda adalah kitab suci agama Hindu yang diturunkan oleh Sang Hyang Widhi.\n\nWeda terdiri dari 4 bagian:\n1. Reg Weda - Berisi pujian kepada para Dewa\n2. Yajur Weda - Berisi tata cara persembahan\n3. Sama Weda - Berisi nyanyian suci\n4. Atharwa Weda - Berisi doa dan mantra\n\nSetiap bagian Weda memiliki fungsi dan tujuan masing-masing dalam kehidupan umat Hindu.",
            'tingkat' => 'SMP',
            'kelas' => '7 SMP',
            'created_by' => $guru1->id,
        ]);

        $lesson3 = Lesson::create([
            'judul' => 'Hari Raya Hindu',
            'deskripsi' => 'Mengenal berbagai hari raya dalam agama Hindu',
            'konten' => "Dalam agama Hindu terdapat berbagai hari raya penting:\n\n1. Galungan - Merayakan kemenangan dharma atas adharma\n2. Kuningan - Hari kembalinya roh leluhur ke surga\n3. Nyepi - Tahun baru Saka, hari untuk merenung\n4. Saraswati - Hari turunnya ilmu pengetahuan\n5. Pagerwesi - Hari untuk memperkuat diri dari pengaruh buruk\n\nSetiap hari raya memiliki makna filosofis yang dalam.",
            'tingkat' => 'SD',
            'kelas' => '5 SD',
            'created_by' => $guru2->id,
        ]);

        // Create Assignments
        $assignment1 = Assignment::create([
            'judul' => 'Membuat Ringkasan Tentang Tri Murti',
            'deskripsi' => "Buatlah ringkasan tentang Tri Murti dalam agama Hindu!\n\nYang harus dicantumkan:\n1. Pengertian Tri Murti\n2. Sebutkan 3 Dewa dalam Tri Murti dan fungsinya\n3. Jelaskan makna Tri Murti dalam kehidupan sehari-hari\n\nMinimal 200 kata.",
            'tingkat' => 'SD',
            'kelas' => '4 SD',
            'tanggal_deadline' => now()->addDays(7),
            'created_by' => $guru1->id,
        ]);

        $assignment2 = Assignment::create([
            'judul' => 'Analisis Bagian-Bagian Weda',
            'deskripsi' => "Buatlah analisis tentang 4 bagian Weda!\n\nTugas:\n1. Jelaskan setiap bagian Weda (Reg, Yajur, Sama, Atharwa)\n2. Berikan contoh penerapannya dalam kehidupan\n3. Mengapa Weda penting bagi umat Hindu?\n\nFormat: Essay minimal 300 kata",
            'tingkat' => 'SMP',
            'kelas' => '7 SMP',
            'tanggal_deadline' => now()->addDays(5),
            'created_by' => $guru1->id,
        ]);

        $assignment3 = Assignment::create([
            'judul' => 'Cerita Pengalaman Hari Raya Galungan',
            'deskripsi' => "Ceritakan pengalaman Anda merayakan hari raya Galungan!\n\nYang perlu diceritakan:\n1. Persiapan sebelum Galungan\n2. Kegiatan saat Galungan\n3. Makna yang Anda rasakan\n4. Pelajaran yang bisa diambil\n\nBoleh ditambahkan foto (opsional)",
            'tingkat' => 'SD',
            'kelas' => '5 SD',
            'tanggal_deadline' => now()->addDays(10),
            'created_by' => $guru2->id,
        ]);

        // Create Attendance
        Attendance::create([
            'user_id' => $siswa1->id,
            'tanggal' => today(),
            'status' => 'hadir',
        ]);

        Attendance::create([
            'user_id' => $siswa2->id,
            'tanggal' => today(),
            'status' => 'hadir',
        ]);

        Attendance::create([
            'user_id' => $siswa3->id,
            'tanggal' => today(),
            'status' => 'sakit',
            'keterangan' => 'Demam',
        ]);

        Attendance::create([
            'user_id' => $siswa4->id,
            'tanggal' => today(),
            'status' => 'hadir',
        ]);

        // Create Assignment Submission
        AssignmentSubmission::create([
            'assignment_id' => $assignment1->id,
            'user_id' => $siswa1->id,
            'jawaban' => 'Tri Murti adalah konsep tiga manifestasi utama Tuhan dalam agama Hindu. Ketiga manifestasi tersebut adalah Brahma sebagai pencipta alam semesta, Wisnu sebagai pemelihara dan pelindung alam semesta, dan Siwa sebagai pelebur atau penghancur. Dalam kehidupan sehari-hari, konsep Tri Murti mengajarkan kita tentang siklus kehidupan yang terus berputar: penciptaan, pemeliharaan, dan peleburan. Kita belajar untuk menciptakan hal-hal positif, memelihara kebaikan, dan melepaskan hal-hal buruk dalam hidup kita.',
            'submitted_at' => now(),
            'nilai' => 85,
            'feedback' => 'Bagus! Penjelasan sudah cukup lengkap. Coba tambahkan contoh konkret dalam kehidupan.',
        ]);
    }
}

