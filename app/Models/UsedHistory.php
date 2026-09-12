<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsedHistory extends Model
{
    //
    protected $table = 'used_histories';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'locker_id',
        'start_time',
        'end_time',
    ];

    public function user() {
        return $this -> belongsTo(User::class);
    }

    public function locker() {
        return $this -> belongTo(Locker::class);
    }
}
