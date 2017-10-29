<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * Get all of the tags for the review.
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
