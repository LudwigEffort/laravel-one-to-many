<?php

namespace App;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public static function getSlug($text) {
        // generare lo slug base
        $slugBase = Str::slug($text);
        $slug = $slugBase;
        $i = 1;

        // trovo il primo slug non usato
        while(Post::where('slug', $slug)->first()) {
            $slug = $slugBase . '-' . $i;
            $i++;
        }

        // ritorno lo slug generato
        return $slug;
    }
}
