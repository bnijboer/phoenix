<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
    ];
    
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['user'];
    
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'permissions',
    ];
    
    /**
     * Returns policy permissions for the model.
     *
     * @return array
     */
    public function getPermissionsAttribute()
    {
        $user = auth()->user();
        
        return [
            'delete' => optional($user)->can('delete', $this),
        ];
    }
    
    /**
     * The post associated with the comments.
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
