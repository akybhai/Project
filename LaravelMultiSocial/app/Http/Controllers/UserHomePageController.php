<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\User;
class UserHomePageController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }


  function index () {
$user = User::find(Auth::id());
    if ($user->role_id != '3')
    {
      return redirect()->route('home');
    }
      $users =  \App\User::all();
      return view('User Homepage.index1');
  }
}
