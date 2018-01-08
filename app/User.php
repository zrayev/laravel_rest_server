<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'posts',
    ];

    /**
     * @return HasMany
     */
    public function posts() {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function generateToken() {
        $this->api_token = str_random(60);
        $this->save();

        return $this->api_token;
    }
}
