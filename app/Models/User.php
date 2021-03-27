<?php

namespace App\Models;

use App\Models\Concerns\IsAdministrator;
use App\Models\Concerns\IsEditor;
use App\Models\Concerns\IsOwner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, IsAdministrator, IsEditor, IsOwner, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avatar',
        'first_name',
        'email',
        'last_name',
        'is_admin',
        'is_banned',
        'is_editor',
        'is_subscribed',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
        'is_banned' => 'boolean',
        'is_editor' => 'boolean',
        'is_subscribed' => 'boolean',
    ];

    /**
     * The posts by the user.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // public function getAvatarAttribute($value)
    // {
    //     if (isset($value)) {
    //         return asset('storage/' . $value);
    //     } else {
    //         return asset('images/default-avatar.jpeg');
    //     }
    // }
}
