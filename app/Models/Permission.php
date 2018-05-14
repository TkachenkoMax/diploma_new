<?php

namespace App\Models;

use Ultraware\Roles\Models\Permission as BasePermission;

/**
 * Class Permission
 * @package App\Models
 */
class Permission extends BasePermission
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'slug',
        'description',
        'model',
    ];
}
