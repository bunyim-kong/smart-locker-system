<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Maintenance extends Model
{
    protected $fillable = [
        'locker_id',
        'user_id',
        'issue_des',
        'report_date',
        'resolve_date',
    ];

    protected function casts(): array
    {
        return [
            'report_date' => 'date',
            'resolve_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function locker(): BelongsTo
    {
        return $this->belongsTo(Locker::class);
    }
}
