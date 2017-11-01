<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
