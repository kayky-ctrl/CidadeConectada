<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReportedIssue;
use App\Models\IssueUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\Api\V1\Admin\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class AdminIssueController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_admin');
    }

    public function index()
    {
        return ReportedIssue::with(['user', 'updates', 'ratings'])->get();
    }

    public function show(ReportedIssue $issue)
    {
        return $issue->load(['user', 'updates', 'ratings']);
    }

    public function updateStatus(Request $request, $issueId)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validate([
                'status' => 'required|in:pending,in_progress,resolved,rejected',
                'comments' => 'nullable|string'
            ]);

            $issue = ReportedIssue::findOrFail($issueId);

            $issue->updates()->create([
                'admin_id' => auth()->id(),
                'status' => $validated['status'],
                'comments' => $validated['comments'] ?? 'Status updated'
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Status updated successfully',
                'data' => $issue->load('updates')
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Issue not found'
            ], 404);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Update status error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Internal server error'
            ], 500);
        }
    }

    public function destroy(ReportedIssue $issue)
    {
        $issue->delete();

        return response()->json(null, 204);
    }
}
