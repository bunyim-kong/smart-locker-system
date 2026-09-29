<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class History extends Model
{
    protected $fillable = ['locker_id', 'user_id', 'start_time', 'end_time', 'access_code'];

    protected $hidden = ['access_code'];

    protected function casts(): array
    {
        return ['start_time' => 'datetime', 'end_time' => 'datetime', 'access_code' => 'encrypted'];
    }

    public function locker(): BelongsTo
    {
        return $this->belongsTo(Locker::class)->withTrashed();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
