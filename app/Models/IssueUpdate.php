<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssueUpdate extends Model
{
    protected $fillable = [
    'reported_issue_id',
    'admin_id',
    'status',
    'comments'
];

    public function reportedIssue()
    {
        return $this->belongsTo(ReportedIssue::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
