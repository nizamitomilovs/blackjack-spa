<?php

namespace App\Models\EloquentModels;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * @var string<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nickname',
    ];

    /**
     * @var array<string>
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
