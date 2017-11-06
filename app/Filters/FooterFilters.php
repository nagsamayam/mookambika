<?php

namespace App\Filters;

class FooterFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['status', 'search', 'start_date', 'end_date'];


    /**
     * Filter the query by a given type.
     *
     * @param  string $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function status($status)
    {
        if ($status === 'unpublished') {
            return $this->builder->onlyTrashed();
        }
    }

    /**
     * Filter the query according to the keywords.
     *
     * @param string $keyword
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function search($keyword)
    {
        return $this->builder
            ->where('title', 'like', "%$keyword%");
    }

    protected function start_date($startDate)
    {
        return $this->builder->whereRaw("date(created_at) >= '$startDate'");
    }

    protected function end_date($endDate)
    {
        return $this->builder->whereRaw("date(created_at) <= '$endDate'");
    }

}
