<?php

namespace App;

use App\Traits\Slugger;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Slugger;

    public $timestamps = false; // serve per disattivare i timestamps comentati nella migration relativa

    public function posts() {
        return $this->hasMany('App\Post');
    }

}
