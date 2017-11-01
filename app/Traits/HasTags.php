<?php
namespace App\Traits;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasTags
{
    /**
     * @param \App\Models\Tag[]|int[] $tags
     */
    public function syncTags(array $tags)
    {
        $this->tags()->sync($tags);
    }

    public function removeTags()
    {
        $this->tags()->detach();
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    }

    public function getTagListAttribute()
    {
        return $this->tags->pluck('id');
    }

    public function getTagTitleListAttribute()
    {
        return $this->tags->pluck('title')->toArray();
    }

    public static function tagsForDropdown()
    {
        $taggables = static::with('tags:id,title')->get();
        $tags = [];
        return $taggables->each(function ($taggable) use ($tags) {
            $taggable->tags->each(function ($tag) {
                $tags[$tag->id] = $tag->title;
            });
            return $tags;
        });
    }
}