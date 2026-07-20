<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssignmentSubmission;
use App\Models\Assignment;
use Illuminate\Support\Facades\Storage;

class AssignmentSubmissionController extends Controller
{
    public function submit(Request $request, $assignmentId)
    {
        $validated = $request->validate([
            'jawaban' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        $validated['assignment_id'] = $assignmentId;
        $validated['user_id'] = auth()->id();
        $validated['submitted_at'] = now();

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('submissions', 'public');
        }

        AssignmentSubmission::updateOrCreate(
            [
                'assignment_id' => $assignmentId,
                'user_id' => auth()->id()
            ],
            $validated
        );

        return redirect()->route('assignments.show', $assignmentId)
            ->with('success', 'Tugas berhasil dikumpulkan!');
    }

    public function grade(Request $request, $submissionId)
    {
        $submission = AssignmentSubmission::findOrFail($submissionId);
        
        // Check if the logged user is the creator of the assignment
        if (auth()->user()->id !== $submission->assignment->created_by) {
            abort(403);
        }

        $validated = $request->validate([
            'nilai' => 'required|integer|min:0|max:100',
            'feedback' => 'nullable|string',
        ]);

        $submission->update($validated);

        return back()->with('success', 'Nilai berhasil diberikan!');
    }
}
