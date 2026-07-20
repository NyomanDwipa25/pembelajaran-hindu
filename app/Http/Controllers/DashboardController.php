<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\AssignmentSubmission;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isGuru()) {
            $totalLessons = Lesson::where('created_by', $user->id)->count();
            $totalAssignments = Assignment::where('created_by', $user->id)->count();
            $totalStudents = \App\Models\User::where('role', 'siswa')->count();
            $recentSubmissions = AssignmentSubmission::whereHas('assignment', function($q) use ($user) {
                $q->where('created_by', $user->id);
            })->latest()->take(5)->get();

            return view('dashboard.guru', compact('totalLessons', 'totalAssignments', 'totalStudents', 'recentSubmissions'));
        } else {
            $lessons = Lesson::where('tingkat', $user->kelas ? (in_array(substr($user->kelas, 0, 2), ['1', '2', '3', '4', '5', '6']) ? 'SD' : 'SMP') : 'SD')
                ->latest()->take(5)->get();
            $assignments = Assignment::where('tingkat', $user->kelas ? (in_array(substr($user->kelas, 0, 2), ['1', '2', '3', '4', '5', '6']) ? 'SD' : 'SMP') : 'SD')
                ->latest()->take(5)->get();
            $todayAttendance = Attendance::where('user_id', $user->id)
                ->whereDate('tanggal', today())->first();

            return view('dashboard.siswa', compact('lessons', 'assignments', 'todayAttendance'));
        }
    }
}
