<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ReportedIssue;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin');
    }

    public function issues()
    {
        $issues = ReportedIssue::with(['user', 'updates'])->latest()->get();
        return view('admin.issues', compact('issues'));
    }

    public function updateStatus(Request $request, ReportedIssue $issue)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,resolved,rejected',
            'comments' => 'nullable|string'
        ]);

        $issue->update(['status' => $validated['status']]);
        
        $issue->updates()->create([
            'admin_id' => auth()->id(),
            'status' => $validated['status'],
            'comments' => $validated['comments'] ?? 'Status atualizado'
        ]);

        return back()->with('success', 'Status atualizado com sucesso!');
    }
}