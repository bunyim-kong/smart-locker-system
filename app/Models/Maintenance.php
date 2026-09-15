<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Maintenance extends Model
{
    protected $fillable = [
        'locker',
        'user',
        'issue_des',
        'report_date',
        'resolve_date',
    ];
    public function users(): HasMany

    {
        return $this-> hasMany(user::class) 
            ->orderBy('');
    }
    // public function lockers(): HasMany

    // {
    //     return $this-> hasMany(locker::class) 
    //         ->orderBy('title');
    // }
}
            