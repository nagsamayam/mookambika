<?php
if (!function_exists('fullTitle')) {
    function fullTitle($pageTitle = ''): string
    {
        if (!$pageTitle) {
            return config('app.name');
        }

        return config('app.name') . ' | ' . $pageTitle;
    }
}
if (!function_exists('timer')) {
    function timer($expression)
    {
        $start = microtime(true);
        if ($expression instanceof Closure) {
            $expression();
        } else {
            eval(rtrim($expression, ';') . ';');
        }
        return microtime(true) - $start . " Seconds";
    }
}

if (!function_exists('tagsForDropdown')) {
    function tagsForDropdown($taggables)
    {
        $tags = [];
        foreach ($taggables as $taggable) {
            foreach ($taggable->tags as $tag) {
                $tags[$tag->id] = $tag->title;
            }
        }
        return $tags;
    }
}

if (! function_exists('activeLabelClass')) {
    function activeLabelClass($value)
    {
        return $value ? 'primary' : 'danger';
    }
}

if (! function_exists('activeLabelText')) {
    function activeLabelText($value)
    {
        return $value ? 'Active' : 'Deleted';
    }
}
