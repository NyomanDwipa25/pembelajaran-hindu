<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isGuru()) {
            $lessons = Lesson::where('created_by', $user->id)->latest()->paginate(10);
        } else {
            $tingkat = $user->kelas ? (in_array(substr($user->kelas, 0, 1), ['1', '2', '3', '4', '5', '6']) ? 'SD' : 'SMP') : 'SD';
            $lessons = Lesson::where('tingkat', $tingkat)->latest()->paginate(10);
        }

        return view('lessons.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lessons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'konten' => 'required|string',
            'tingkat' => 'required|in:SD,SMP',
            'kelas' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
        ]);

        $validated['created_by'] = auth()->id();

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('lessons', 'public');
        }

        Lesson::create($validated);

        return redirect()->route('lessons.index')->with('success', 'Pembelajaran berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lesson = Lesson::findOrFail($id);
        return view('lessons.show', compact('lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lesson = Lesson::findOrFail($id);
        
        if (auth()->user()->id !== $lesson->created_by) {
            abort(403);
        }

        return view('lessons.edit', compact('lesson'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lesson = Lesson::findOrFail($id);
        
        if (auth()->user()->id !== $lesson->created_by) {
            abort(403);
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'konten' => 'required|string',
            'tingkat' => 'required|in:SD,SMP',
            'kelas' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
        ]);

        if ($request->hasFile('file')) {
            if ($lesson->file) {
                Storage::disk('public')->delete($lesson->file);
            }
            $validated['file'] = $request->file('file')->store('lessons', 'public');
        }

        $lesson->update($validated);

        return redirect()->route('lessons.index')->with('success', 'Pembelajaran berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lesson = Lesson::findOrFail($id);
        
        if (auth()->user()->id !== $lesson->created_by) {
            abort(403);
        }

        if ($lesson->file) {
            Storage::disk('public')->delete($lesson->file);
        }

        $lesson->delete();

        return redirect()->route('lessons.index')->with('success', 'Pembelajaran berhasil dihapus!');
    }
}
