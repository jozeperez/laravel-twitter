<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'avatar'
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function timeline()
    {
        $friends = $this->follows()->pluck('id');

        return Tweet::whereIn('user_id', $friends)
            ->withLikes()
            ->orWhere('user_id', $this->id)
            ->latest()
            ->paginate(5);
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class)->latest();
    }

    public function getAvatarAttribute($value)
    {
        if (!empty($value))
        {
            return asset("storage/".$value);
        }

        return "https://i.pravatar.cc/200?u=" . $this->email;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function path($append = '')
    {
        $path = route('profile', $this->username);

        return $append ? "{$path}/{$append}" : $path;
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
