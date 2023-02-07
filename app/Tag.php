<?php

namespace App;

use App\Traits\Slugger;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // per usare la funzione nel traits
    use Slugger;

    // per disattivare i timestamps della tabella tags
    public $timestamps = false;

    // relazione Many to Many con Post
    public function posts() {
        return $this->belongsToMany('App\Post');
    }
}
