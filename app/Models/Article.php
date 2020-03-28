<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    function getCategory($value='')
    {
      return $this->hasOne('App\Models\Category','id','category');
    }
}
