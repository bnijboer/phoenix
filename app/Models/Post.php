<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body',
        'image',
        'title',
        'user_id',
    ];

    /**
     * The user that owns the posts.
     */
    public function user()
    {
        return $this->belongsTo(Post::class);
    }
}