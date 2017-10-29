<?php

namespace App\Models;

use App\Filters\TagFilters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    protected $fillable = ['title', 'meta_description'];
    protected $dates = ['created_at'];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($tag) {
            $tag->news->each->delete();
            $tag->faqs->each->delete();
            $tag->reviews->each->delete();
            //$tag->pages->each->delete();
        });
    }

    /**
     * Get all of the reviews that are assigned this tag.
     */
    public function reviews(): MorphToMany
    {
        return $this->morphedByMany(Review::class, 'taggable');
    }

    /**
     * Get all of the News that are assigned this tag.
     */
    public function news(): MorphToMany
    {
        return $this->morphedByMany(News::class, 'taggable');
    }

    /**
     * Get all of the FAQs that are assigned this tag.
     */
    public function faqs(): MorphToMany
    {
        return $this->morphedByMany(Faq::class, 'taggable');
    }

    public function scopeFilter($query, TagFilters $filters)
    {
        return $filters->apply($query);
    }
}
