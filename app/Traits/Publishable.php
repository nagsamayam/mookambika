<?php

namespace App\Traits;

use Carbon\Carbon;

trait Publishable
{
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    public function scopeUnpublished($query)
    {
        return $query->whereNull('published_at');
    }

    public function scopeRecent($query)
    {
        return $query->latest('published_at');
    }

    public function scopeLegacy($query)
    {
        return $query->oldest('published_at');
    }

    public function publish()
    {
        $this->update(['published_at' => $this->freshTimestamp()]);
    }

    public function unpublish()
    {
        $this->update(['published_at' => null]);
    }

    public function isPublished()
    {
        return $this->published_at !== null;
    }

    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);
    }

    public function getPublishedAtAttribute($date)
    {
        return date('Y-m-d', strtotime($date));
    }

    public function getPublishedDateAttribute()
    {
        return Carbon::parse($this->published_at)->toFormattedDateString();
    }

}