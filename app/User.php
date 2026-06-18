<?php

namespace App;

use App\RealWorld\Follow\Followable;
use App\RealWorld\Favorite\HasFavorite;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, Followable, HasFavorite;

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'bio',
        'image'
    ];

    /**
     * Hidden fields for arrays / JSON
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Auto-hash password
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] =
            (password_get_info($value)['algo'] === 0)
            ? bcrypt($value)
            : $value;
    }

    /**
     * RELATION: Articles
     */
    public function articles()
    {
        return $this->hasMany(Article::class)->latest();
    }

    /**
     * RELATION: Comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    /**
     * FEED: Articles from followed users
     */
    public function feed()
    {
        $followingIds = $this->following()->pluck('id')->toArray();

        return Article::loadRelations()
            ->whereIn('user_id', $followingIds);
    }

    /**
     * Route model binding
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * JWT: get user ID stored in token
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * JWT: custom claims
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}