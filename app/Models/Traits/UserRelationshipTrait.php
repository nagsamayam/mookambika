<?php

namespace App\Models\Traits;

use App\Models\Faq;
use App\Models\Footer;
use App\Models\News;
use App\Models\Review;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserRelationshipTrait
{
    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function footers(): HasMany
    {
        return $this->hasMany(Footer::class);
    }
}
