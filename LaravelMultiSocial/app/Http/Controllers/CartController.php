<?php
/**
 * Created by PhpStorm.
 * User: sanjeev halyal
 * Date: 30-03-2018
 * Time: 22:09
 */

namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Facades\Auth;
use App\User;
class CartController  extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke()
    {
        $user = User::find(Auth::id());
        if ($user->role_id != '3') {
            return redirect('/');

        }
        if($user->mobile==null)
        {
            return redirect('/home');
        }

        return view('cart/cart');
    }
}