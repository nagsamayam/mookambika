<?php

namespace App\Models;

use App\Traits\HasTags;
use App\Traits\Publishable;
use App\Filters\FaqFilters;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasTags, Publishable;

    protected $table = 'faqs';

    protected $fillable = ['title', 'content', 'meta_description', 'published_at'];
    protected $dates = ['published_at', 'created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($faq) {
            $faq->tags()->detach();
        });
    }

    public function scopeFilter($query, FaqFilters $filters)
    {
        return $filters->apply($query);
    }

    public function publish()
    {
        $this->restore();
    }

    public function unpublish()
    {
        $this->update(['published_at' => null]);
    }
}
