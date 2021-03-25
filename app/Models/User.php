<?php

namespace App\Models;

use App\Models\Concerns\IsAdministrator;
use App\Models\Concerns\IsEditor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, IsAdministrator, IsEditor, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'is_admin',
        'is_editor',
        'name',
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
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
        'is_editor' => 'boolean',
    ];

    /**
     * The posts by the user.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
