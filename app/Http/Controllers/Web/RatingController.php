<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ReportedIssue;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function create(ReportedIssue $issue)
    {
        // Só permite se o status for resolvido e o usuário for o dono
        if ($issue->status !== 'resolved' || $issue->user_id !== auth()->id()) {
            abort(403);
        }
        return view('ratings.create', compact('issue'));
    }

    public function store(Request $request, ReportedIssue $issue)
    {
        if ($issue->status !== 'resolved' || $issue->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        // Só permite uma avaliação por usuário por issue
        if ($issue->ratings()->where('user_id', auth()->id())->exists()) {
            return redirect()->route('issues.index')->with('error', 'Você já avaliou este report.');
        }

        $issue->ratings()->create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('issues.index')->with('success', 'Avaliação enviada com sucesso!');
    }
}
