<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    public function products()
    {
      return $this->belongsTo('App\Product','productID');
    }
    
    public function users()
    {
      return $this->belongsTo('App\User','id');
    }
}
