<?php

namespace App\Filters;

class FaqFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['status', 'search', 'tags',
        'published_start_date', 'published_end_date', ];

    /**
     * Filter the query by a given type.
     *
     * @param string $status
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function status($status)
    {
        return $this->builder->{ucfirst($status)}();
    }

    /**
     * Filter the query according to the keywords.
     *
     * @param string $keyword
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function search($keyword)
    {
        return $this->builder
            ->where('title', 'like', "%$keyword%")
            ->orWhere('content', 'like', "%$keyword%");
    }

    protected function sort_direction($direction = 'desc')
    {
        $scope = $direction === 'desc' ? 'recent' : 'legacy';

        return $this->builder->{$scope}();
    }

    protected function published_start_date($startDate)
    {
        return $this->builder->whereRaw("date(published_at) >= '$startDate'");
    }

    protected function published_end_date($endDate)
    {
        return $this->builder->whereRaw("date(published_at) <= '$endDate'");
    }

    protected function tags()
    {
        return $this->builder->join('taggables', 'taggables.taggable_id', '=', 'faqs.id')
            ->where('taggables.taggable_type', '=', 'App\\Models\\Faq')
            ->whereIn('taggables.tag_id', request('tags'));
    }
}
