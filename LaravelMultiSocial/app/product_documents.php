<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_documents extends Model
{
  //
  public function products()
  {
    return $this->belongsTo('App\Product','productID');
  }
}
