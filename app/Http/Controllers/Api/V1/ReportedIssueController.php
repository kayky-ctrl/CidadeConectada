<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ReportedIssue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReportedIssueController extends Controller
{
    public function index()
    {
        return ReportedIssue::where('user_id', Auth::id())->get();
    }

    public function store(Request $request)
    {
        Log::info('Dados recebidos:', $request->all()); // Log dos dados de entrada

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'category' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        Log::info('Dados validados:', $validated); // Log dos dados validados

        try {
            $issue = ReportedIssue::create(array_merge($validated, [
                'user_id' => Auth::id(),
                'status' => 'pending',
            ]));

            Log::info('Issue criada:', $issue->toArray()); // Log do objeto criado

            return response()->json($issue, 201);
        } catch (\Exception $e) {
            Log::error('Erro ao criar issue:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Erro interno'], 500);
        }
    }

    public function show(ReportedIssue $issue)
    {
        if ($issue->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return $issue;
    }

    public function update(Request $request, ReportedIssue $issue)
    {
        if ($issue->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'location' => 'sometimes|string',
        ]);

        $issue->update($request->only(['title', 'description', 'location']));

        return $issue;
    }

    public function destroy(ReportedIssue $issue)
    {
        if ($issue->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $issue->delete();

        return response()->json(null, 204);
    }

    public function rate(Request $request, ReportedIssue $issue)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string',
        ]);

        if ($issue->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($issue->status !== 'resolved') {
            abort(400, 'You can only rate resolved issues.');
        }

        $rating = $issue->ratings()->create([
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json($rating, 201);
    }
}
