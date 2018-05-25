<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
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

    const CONTACT_REQUESTED_STATUS = 1;
    const CONTACT_ACCEPTED_STATUS  = 2;

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
    public function getFullNameAttribute() {
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
        $lastAvatar = $this->getLastAvatar();

        if (!is_null($lastAvatar) && Storage::disk('s3')->exists($lastAvatar->link)) {
            return Storage::disk('s3')->url($lastAvatar->link);
        }

        return $this->sex ? Storage::disk('s3')->url('avatars/user_woman.png') : Storage::disk('s3')->url('avatars/user_man.png');
    }

    /**
     * Return collection of incoming contacts requests.
     *
     * @return mixed
     */
    public function getIncomingContactRequests()
    {
        $ids = DB::table('user_contacts')
            ->where('user_b_id', $this->id)
            ->where('status', self::CONTACT_REQUESTED_STATUS)
            ->get()
            ->pluck('user_a_id')
            ->toArray();

        return User::find($ids);
    }

    /**
     * Return collection of outcoming contacts requests.
     *
     * @return mixed
     */
    public function getOutcomingContactRequests()
    {
        $ids = DB::table('user_contacts')
            ->where('user_a_id', $this->id)
            ->where('status', self::CONTACT_REQUESTED_STATUS)
            ->get()
            ->pluck('user_b_id')
            ->toArray();

        return User::find($ids);
    }

    /**
     * Find user's contacts.
     *
     * @return mixed
     */
    public function getContacts()
    {
        $idsA = DB::table('user_contacts')
            ->where('user_a_id', $this->id)
            ->where('status', self::CONTACT_ACCEPTED_STATUS)
            ->get()
            ->pluck('user_b_id')
            ->toArray();

        $idsB = DB::table('user_contacts')
            ->where('user_b_id', $this->id)
            ->where('status', self::CONTACT_ACCEPTED_STATUS)
            ->get()
            ->pluck('user_a_id')
            ->toArray();
        
        return User::find(array_merge($idsA, $idsB));
    }

    /**
     * Get calendars created by user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function myCalendars()
    {
        return $this->hasMany('App\Models\UserAvatar', 'creator_id', 'id');
    }

    /**
     * Get all user's calendars.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function calendars()
    {
        return $this->belongsToMany('App\Models\Calendar');
    }
}
