<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isGuru()) {
            $attendances = Attendance::with('user')
                ->whereDate('tanggal', today())
                ->latest()
                ->paginate(20);
            $students = User::where('role', 'siswa')->get();
            
            return view('attendances.index-guru', compact('attendances', 'students'));
        } else {
            $attendances = Attendance::where('user_id', $user->id)
                ->latest()
                ->paginate(10);
            $todayAttendance = Attendance::where('user_id', $user->id)
                ->whereDate('tanggal', today())
                ->first();
            
            return view('attendances.index-siswa', compact('attendances', 'todayAttendance'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $todayAttendance = Attendance::where('user_id', auth()->id())
            ->whereDate('tanggal', today())
            ->first();
            
        if ($todayAttendance) {
            return redirect()->route('attendances.index')
                ->with('info', 'Anda sudah melakukan absen hari ini.');
        }
        
        return view('attendances.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:hadir,izin,sakit,alpha',
            'keterangan' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['tanggal'] = today();

        // Check if already exists today
        $exists = Attendance::where('user_id', auth()->id())
            ->whereDate('tanggal', today())
            ->first();

        if ($exists) {
            return redirect()->route('attendances.index')
                ->with('error', 'Anda sudah melakukan absen hari ini.');
        }

        Attendance::create($validated);

        return redirect()->route('attendances.index')
            ->with('success', 'Absen berhasil dicatat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function report(Request $request)
    {
        $startDate = $request->input('start_date', today()->startOfMonth());
        $endDate = $request->input('end_date', today());
        
        $attendances = Attendance::with('user')
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->latest('tanggal')
            ->get();
            
        return view('attendances.report', compact('attendances', 'startDate', 'endDate'));
    }
}
