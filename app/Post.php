<?php

namespace App;

use App\Traits\Slugger;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // per usare la funzione nel traits
    use Slugger;

    // relazione one to Many tra con Category
    public function category() {
        return $this->belongsTo('App\Category');
    }

    // relazione Many to Many con Tag
    public function tags() {
        return $this->belongsToMany('App\Tag');
    }

    // per usare nei link (url della pagina) lo slug anzichè l'id
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
