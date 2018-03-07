<?php

namespace App\Filters;

class SectionFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['search'];

    /**
     * Filter the query according to those that are unanswered.
     *
     * @param string $keyword
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function search($keyword)
    {
        return $this->builder->where('title', 'like', "%$keyword%");
    }
}
