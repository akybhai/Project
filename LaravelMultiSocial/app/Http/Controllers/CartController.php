<?php
/**
 * Created by PhpStorm.
 * User: sanjeev halyal
 * Date: 30-03-2018
 * Time: 22:09
 */

namespace App\Http\Controllers;

use DB;
use DateTime,DateInterval,DatePeriod;
class CartController  extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke()
    {
        return view('cart/cart');
    }
}