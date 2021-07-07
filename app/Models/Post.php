<?php

namespace App\Models;

use App\Models\Scopes\PublishedScope;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body',
        'image',
        'is_published',
        'published_at',
        'slug',
        'title',
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_published' => 'boolean',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new PublishedScope);
    }
    
    /**
     * Bootstrap the model and its traits.
     *
     * @return bool
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function($model) {
            $slug = Str::slug($model->title);
            $count = 1;
            
            while (static::whereSlug($slug)->where('id', '!=', $model->id)->exists()) {
                $slug = Str::slug($model->title . ' ' . $count++);
            }
            
            $model->slug = $slug;

            return true;
        });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * The comments for the post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * The tags that belong to the post.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * The user that owns the posts.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Synchronizes the tags belonging to the post.
     *
     * @param array $tags
     */
    public function syncTags(array $tags)
    {
        $keywords = collect($tags)->pluck('keyword')->filter();
        
        $this->removeUnusedTags($keywords);
        
        !count($keywords) ?: $this->addTags($keywords);
    }

    /**
     * Handles the tags to be attached to the post.
     *
     * @param Collection $keywords
     */
    private function addTags(Collection $keywords)
    {
        foreach ($keywords as $keyword) {
            if (! $this->tags->containsStrict('keyword', $keyword)) {
                $tag = Tag::firstOrCreate(
                    compact('keyword'),
                    ['slug' => Str::slug($keyword)]
                );
                
                $this->tags()->attach($tag);
            }
        }
    }

    /**
     * Detaches tags from a post and removes them from storage if they have no (other) related posts.
     *
     * @param Collection $keywords
     */
    private function removeUnusedTags(Collection $keywords)
    {
        foreach ($this->tags as $tag) {
            if (! $keywords->contains($tag->keyword)) {
                $this->tags()->detach($tag);
                
                count($tag->posts) ?: $tag->delete();
            }
        }
    }

    /**
     * Publishes a post if it is scheduled for today.
     */
    public function publishIfDue()
    {   
        if (Carbon::parse($this->published_at)->isToday()) {
            $this->update(['is_published' => true]);
        }
    }
}
