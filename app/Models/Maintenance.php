<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Maintenance extends Model
{
    protected $fillable = [
        'locker_id',
        'user_id',
        'issue_des',
        'report_date',
        'resolve_date',
    ];

    public function user()
    {
        return $this-> belongsTo(User::class);
    }

    public function locker()
    {
        return $this-> belongsTo(Locker::class);
    }
}
            