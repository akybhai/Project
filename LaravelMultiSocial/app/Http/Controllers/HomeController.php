<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
use Mail;
use DateTime;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = User::find(Auth::id());
        //$bookID = 1;
        //$collectData = DB::table('transactions')->where('booking_id', $bookID)->first();
      //check if the user has admin role
      if ($user->role_id != '3')
      {
        // need to be admin


          $fromdate = new DateTime();
          $inTran = \DB::select('select booking_id as id from transactions WHERE
  START_DATE<?
  AND booking_status in ("pending")',
              [$fromdate]);

          foreach($inTran as $it)
          {
              DB:: table('transactions')->where('booking_id', $it->id)->update(['booking_status' => 'declined']);
              $id= $it->id;


              $articles = DB::table('transactions')->leftJoin('products', 'transactions.product_id', '=', 'products.productID')
                  ->leftJoin('users', 'transactions.user_id', '=', 'users.id')
                  ->select('transactions.*', 'products.name as productname', 'users.name as username', 'mobile', 'email')->where('booking_id', $id)->get();


              $userstaff = \DB::select("SELECT * FROM users WHERE role_id!='3' order by ID DESC ");

              // trigger mail
              $admin = 'm.panda1@nuigalway.ie';

              $subject = "Request Expired";
              $template_path = 'Mail.declinmail';



              $staffandadmin = array();
              foreach ($userstaff as $key => $staffarr) {

                  array_push($staffandadmin, $staffarr->email);


              }


              $email = $articles[0]->email;
              $name = $articles[0]->username;


              $data = array('array' => $articles);

              Mail::send($template_path, $data, function ($message) use ($email, $staffandadmin, $name, $subject) {
                  // Set the receiver and subject of the mail.
                  $message->to($email, $name)->subject($subject);
                  // Set the sender
                  $message->from('s.halyal1@nuigalway.ie', 'NUIGsocs Inventory Mail');
                  $message->cc($staffandadmin);
              });

              // end of mail trigger


          }
        return view('staffadmin.pages.dashboard');
          //print_r($collectData);
          ///return view('staffadmin.pages.dashboard', compact('collectData'));
      }
      else {


          return view('home');
      }
    }

    /**
     * Registration of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function userRegistration(Request $request)
    {

    $user = User::find(Auth::id());

    //Check if the the user mobile number is present.
    if($request->has('tel'))
    {
      //Check if the
      $user->mobile = $request->input('tel');
    }

    $user->save();

    return redirect('/');
    }

    // User's Request Page
  public function userrequestdata(Request $request)
  {
    $user = User::find(Auth::id());
      if ($user->role_id != '3') {
          return redirect('/');

      }

      if($user->mobile==null)
      {
          return redirect('/home');
      }

    $getData = DB::table('transactions')->where([['user_id',$user->id],['booking_status','pending']])->get();
    $getDataa = DB::table('transactions')->where([['user_id',$user->id],['booking_status','approved']])->orWhere([['user_id',$user->id],['booking_status','collected']])->orWhere([['user_id',$user->id],['booking_status','returned']])->get();
    $getDataaa = DB::table('transactions')->where([['user_id',$user->id],['booking_status','declined']])->get();
  //  return view('User Homepage.userrequest');
    //return view('User Homepage.userrequest',compact('getData'));
    return view('User Homepage.userrequest',compact('getData','getDataa','getDataaa'));

    //return view('User Homepage.userrequest');

  }

}
