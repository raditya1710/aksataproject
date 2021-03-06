<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

	/**
     * The primary key of User
     *
     * @var string
     */
    public $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nim', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	/**
     * The roles that are available for the users.
     *
     * @var array
     */
    public static $roles = ['admin', 'spectator', 'user', 'public'];

    public function profile(){
        return $this->hasOne('\App\Profile', 'user_nim', 'nim');
    }

    public function achievement(){
        return $this->belongsToMany('\App\Achievement');
    }

    /**
     * Check if the current user is allowed to edit profiles
     * for a given nim.
     *
     * @param $nim
     */
    public function isAllowedToEdit($nim)
    {
        // it is allowed if the nim matches current user, or current user is an admin
        return $this->nim == $nim || $this->role == 'admin';
    }
}
