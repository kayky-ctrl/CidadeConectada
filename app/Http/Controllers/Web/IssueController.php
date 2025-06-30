<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ReportedIssue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
{
    public function index()
    {
        $issues = auth()->user()->reportedIssues()->latest()->get();
        return view('issues.index', compact('issues'));
    }

    public function create()
    {
        return view('issues.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'category' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $issue = auth()->user()->reportedIssues()->create($validated);

        return redirect()->route('issues.index')->with('success', 'Issue reportado com sucesso!');
    }

    public function updateStatus(Request $request, ReportedIssue $issue)
    {
        $adminId = Auth::id();

        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,resolved,rejected',
            'comments' => 'nullable|string'
        ]);

        $issue->update(['status' => $validated['status']]);
        
        $issue->updates()->create([
            'admin_id' => $adminId,
            'status' => $validated['status'],
            'comments' => $validated['comments'] ?? 'Status atualizado'
        ]);

        return back()->with('success', 'Status atualizado com sucesso!');
    }
}