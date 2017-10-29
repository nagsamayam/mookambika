<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Page extends Model
{
    protected $fillable = [
        'user_id',
        'layout',
        'type',
        'title',
        'footer_id',
        'footer_title',
        'color',
        'seo_title',
        'meta_keywords',
        'meta_description',
        'slug',
        'published_at',
    ];

    protected $dates = ['published_at', 'created_at', 'deleted_at'];

    /**
     * Get the footer record associated with the page.
     */
    public function footer(): HasOne
    {
        return $this->hasOne(Footer::class);
    }

    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(Section::class)
            ->withPivot('section_title', 'content', 'sequence', 'mobile_enabled')
            ->withTimestamps();
    }

    /**
     * Get home page
     *
     * @param $query
     * @return mixed
     */
    public function scopeHomePage($query)
    {
        return $query->whereType('home')
            ->oldest()
            ->first();
    }

    public function newPivot(Model $parent, array $attributes, $table, $exists, $using = NULL)
    {
        if ($parent instanceof Section) {
            return new PageSectionPivot($parent, $attributes, $table, $exists);
        }
        return parent::newPivot($parent, $attributes, $table, $exists);
    }
}
