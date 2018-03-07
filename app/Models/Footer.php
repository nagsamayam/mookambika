<?php

namespace App\Models;

use App\Filters\FooterFilters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Footer extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'content'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get the page that owns the footer.
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function scopeFilter($query, FooterFilters $filters)
    {
        return $filters->apply($query);
    }

    public function getCreatedDateAttribute($date)
    {
        return $this->created_at->toDateString();
    }
}
