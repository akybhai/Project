<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use \App\User;
class TestController extends Controller
{
  function index () {
      $users =  \App\User::all();
      return view('welcome');
  }
}
