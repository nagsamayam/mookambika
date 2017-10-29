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
