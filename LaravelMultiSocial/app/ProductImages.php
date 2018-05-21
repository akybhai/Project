<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    //
    public function products()
    {
      return $this->belongsTo('App\Product','productID');
    }
}
