<?php

namespace App;

use App\Traits\Slugger;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Slugger;

    public function category() {
        return $this->belongsTo('App\Category');
    }

    //per usare nei link lo slug anzichè l'id
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
