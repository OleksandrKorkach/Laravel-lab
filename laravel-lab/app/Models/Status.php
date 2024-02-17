<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;

    const TODO = 1;
    const IN_PROGRESS = 2;
    const DONE = 3;
    const PENDING_REVIEW = 4;
    const BLOCKED = 5;
    const HIGH_PRIORITY = 6;
    const LOW_PRIORITY = 7;
    const NEEDS_CLARIFICATION = 8;
    const IN_REVIEW = 9;
    const READY_FOR_TESTING = 10;
    const WAITING_FOR_APPROVAL = 11;
    const ON_HOLD = 12;
    const IN_DISCUSSION = 13;
    const SCHEDULED = 14;
    const BUG_FIXING = 15;
    const FEATURE_DEVELOPMENT = 16;
    const DOCUMENTATION = 17;
    const UI_UX_DESIGN = 18;
    const INTEGRATION_TESTING = 19;
    const DEPLOYMENT = 20;

    protected $fillable = [
        'name',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function projects() : BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }
}
