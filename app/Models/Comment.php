<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'user_id',
    ];
    
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['user'];
    
    /**
     * The user that owns the posts.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    
    /**
     * The user that owns the posts.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
