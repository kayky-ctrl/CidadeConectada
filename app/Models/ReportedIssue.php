<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReportedIssue extends Model
{
    protected $fillable = [
    'title',
    'description',
    'location',
    'category',
    'status',
    'photo_path',
    'user_id'
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function updates(): HasMany
    {
        return $this->hasMany(IssueUpdate::class, 'reported_issue_id');
    }
}

