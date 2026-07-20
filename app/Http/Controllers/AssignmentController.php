<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isGuru()) {
            $assignments = Assignment::where('created_by', $user->id)->latest()->paginate(10);
        } else {
            $tingkat = $user->kelas ? (in_array(substr($user->kelas, 0, 1), ['1', '2', '3', '4', '5', '6']) ? 'SD' : 'SMP') : 'SD';
            $assignments = Assignment::where('tingkat', $tingkat)->latest()->paginate(10);
        }

        return view('assignments.index', compact('assignments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('assignments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tingkat' => 'required|in:SD,SMP',
            'kelas' => 'required|string',
            'tanggal_deadline' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
        ]);

        $validated['created_by'] = auth()->id();

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('assignments', 'public');
        }

        Assignment::create($validated);

        return redirect()->route('assignments.index')->with('success', 'Tugas berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $assignment = Assignment::with('submissions.user')->findOrFail($id);
        $userSubmission = null;

        if (auth()->user()->isSiswa()) {
            $userSubmission = AssignmentSubmission::where('assignment_id', $id)
                ->where('user_id', auth()->id())
                ->first();
        }

        return view('assignments.show', compact('assignment', 'userSubmission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $assignment = Assignment::findOrFail($id);
        
        if (auth()->user()->id !== $assignment->created_by) {
            abort(403);
        }

        return view('assignments.edit', compact('assignment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $assignment = Assignment::findOrFail($id);
        
        if (auth()->user()->id !== $assignment->created_by) {
            abort(403);
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tingkat' => 'required|in:SD,SMP',
            'kelas' => 'required|string',
            'tanggal_deadline' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
        ]);

        if ($request->hasFile('file')) {
            if ($assignment->file) {
                Storage::disk('public')->delete($assignment->file);
            }
            $validated['file'] = $request->file('file')->store('assignments', 'public');
        }

        $assignment->update($validated);

        return redirect()->route('assignments.index')->with('success', 'Tugas berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $assignment = Assignment::findOrFail($id);
        
        if (auth()->user()->id !== $assignment->created_by) {
            abort(403);
        }

        if ($assignment->file) {
            Storage::disk('public')->delete($assignment->file);
        }

        $assignment->delete();

        return redirect()->route('assignments.index')->with('success', 'Tugas berhasil dihapus!');
    }
}
