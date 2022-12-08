<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;

class Post
{
    public static function find($slug)
    {
        if (!file_exists($path = resource_path("/posts/{$slug}.html"))) {
            throw new ModelNotFoundException();
        }

        return Cache::remember("posts/{$slug}", 5, function () use ($path) {
            return file_get_contents($path);
        });

    }
}
