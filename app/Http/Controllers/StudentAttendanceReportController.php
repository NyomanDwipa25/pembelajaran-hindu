<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;

class StudentAttendanceReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', today()->startOfMonth());
        $endDate = $request->input('end_date', today());

        // Get all students with their attendance statistics
        $students = User::where('role', 'siswa')
            ->select('id', 'name', 'email', 'kelas', 'no_induk')
            ->withCount([
                'attendances as total_hadir' => function($query) use ($startDate, $endDate) {
                    $query->where('status', 'hadir')
                        ->whereBetween('tanggal', [$startDate, $endDate]);
                },
                'attendances as total_izin' => function($query) use ($startDate, $endDate) {
                    $query->where('status', 'izin')
                        ->whereBetween('tanggal', [$startDate, $endDate]);
                },
                'attendances as total_sakit' => function($query) use ($startDate, $endDate) {
                    $query->where('status', 'sakit')
                        ->whereBetween('tanggal', [$startDate, $endDate]);
                },
                'attendances as total_alpha' => function($query) use ($startDate, $endDate) {
                    $query->where('status', 'alpha')
                        ->whereBetween('tanggal', [$startDate, $endDate]);
                },
                'attendances as total_kehadiran' => function($query) use ($startDate, $endDate) {
                    $query->whereBetween('tanggal', [$startDate, $endDate]);
                }
            ])
            ->orderBy('kelas')
            ->orderBy('name')
            ->get();

        return view('attendances.student-report', compact('students', 'startDate', 'endDate'));
    }
}
