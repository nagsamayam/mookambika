<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    /**
     * Get all of the tags for the Faq.
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
