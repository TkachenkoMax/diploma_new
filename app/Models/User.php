<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Ultraware\Roles\Traits\HasRoleAndPermission;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoleAndPermission;

    const SEX = [
        0 => 'Man',
        1 => 'Woman'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * Get Roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get Permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Return fullanme of a user.
     *
     * @return string
     */
    public function getFullName() {
        return $this->firstname . ' ' . $this->lastname;
    }

    /**
     * Returns user's sex in string presentation.
     *
     * @return mixed
     */
    public function getSex()
    {
        return self::SEX[$this->sex];
    }

    /**
     * Get user's avatars.
     */
    public function avatars()
    {
        return $this->hasMany('App\Models\UserAvatar');
    }

    /**
     * Get lats user's avatar.
     *
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function getLastAvatar()
    {
        return $this->avatars()->latest()->first();
    }

    /**
     * Return path to profile picture or default picture on AWS.
     *
     * @return string
     */
    public function getAvatarUrl()
    {
        if (!is_null($this->getLastAvatar()) && Storage::disk('s3')->exists($this->getLastAvatar()->link)) {
            return Storage::disk('s3')->url($this->getLastAvatar()->link);
        }

        return $this->sex ? Storage::disk('s3')->url('avatars/user_woman.png') : Storage::disk('s3')->url('avatars/user_man.png');
    }
}
