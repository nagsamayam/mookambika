<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class TaggablesController extends Controller
{
    public function index($type)
    {
        $tags = Tag::with($type)->orderBy('title')->paginate(4, ['id', 'title'])
            ->mapWithKeys(function ($tag) {
                return [$tag['id'] => $tag['title']];
            });
    }
}
