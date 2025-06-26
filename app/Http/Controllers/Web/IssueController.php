<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ReportedIssue;
use Illuminate\Http\Request;

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
}