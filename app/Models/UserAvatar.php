<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAvatar extends Model
{
    use SoftDeletes;

    protected $table = 'user_avatars';

    /**
     * Get the user that owns the avatar.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
