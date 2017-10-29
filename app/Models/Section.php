<?php

namespace App\Models;

use App\Filters\SectionFilters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Section extends Model
{
    protected $fillable = ['title'];
    public $timestamps = false;

    public function pages(): BelongsToMany
    {
        return $this->belongsToMany(Page::class)
            ->withPivot('section_title', 'sequence', 'mobile_enabled')
            ->withTimestamps();
    }

    public function newPivot(Model $parent, array $attributes, $table, $exists, $using = NULL)
    {
        if ($parent instanceof Page) {
            return new PageSectionPivot($parent, $attributes, $table, $exists);
        }
        return parent::newPivot($parent, $attributes, $table, $exists);
    }

    public function scopeFilter($query, SectionFilters $filters)
    {
        return $filters->apply($query);
    }
}
