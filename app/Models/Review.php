<?php

namespace App\Models;

use App\Filters\ReviewFilters;
use App\Traits\HasTags;
use App\Traits\Publishable;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasTags, Publishable;

    protected $fillable = ['reviewer_name', 'reviewer_avatar', 'reviewer_designation',
        'reviewer_organization', 'reviewer_location', 'rating', 'content', 'published_at', ];
    protected $dates = ['published_at', 'created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($review) {
            $review->tags()->detach();
        });

        static::created(function ($review) {
            $review->update(['published_at' => $review->created_at]);
        });
    }

    public function scopeFilter($query, ReviewFilters $filters)
    {
        return $filters->apply($query);
    }

    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = $date;
    }

    public function getAvatarAttribute(): string
    {
        return $this->reviewer_avatar ? asset('storage/'.$this->reviewer_avatar)
            : asset('images/default_avatar.png');
    }

    public static function latestRecord()
    {
        return static::recent()->published()->first(['id', 'published_at']);
    }

    public static function oldestRecord()
    {
        return static::legacy()->published()->first(['id', 'published_at']);
    }
}
