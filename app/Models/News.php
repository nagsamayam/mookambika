<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    /**
     * Get all of the tags for the news.
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
