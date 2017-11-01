<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasTags;
use App\Traits\Publishable;
use App\Filters\NewsFilters;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasTags, HasSlug, Publishable;

    protected $table = 'news';

    protected $fillable = ['title', 'summary', 'content', 'meta_description', 'published_at', 'slug'];
    protected $dates = ['published_at', 'created_at', 'updated_at'];
    protected $casts = [
        // 'published_at' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($news) {
            $news->tags()->detach();
        });
        static::created(function ($news) {
            $news->update(['slug' => $news->title]);
        });
    }

    public function scopeFilter($query, NewsFilters $filters)
    {
        return $filters->apply($query);
    }

    public static function latestRecord()
    {
        return static::recent()->published()->first(['id', 'published_at']);
    }

    public static function oldestRecord()
    {
        return static::legacy()->published()->first(['id', 'published_at']);
    }
    /**
     * Set the proper slug attribute.
     *
     * @param string $value
     */
    /*public function setSlugAttribute($value)
    {
        if (static::whereSlug($slug = str_slug($value))->exists()) {
            $slug = "{$slug}-{$this->id}";
        }
        $this->attributes['slug'] = $slug;
    }*/

}
