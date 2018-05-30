<?php
/**
 * Created by PhpStorm.
 * User: sanjeev halyal
 * Date: 25-05-2018
 * Time: 08:05
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Mail;
use DB;

class CheckoutController  extends Controller
{

    public function checkout(Request $request)
    {
        $user = User::find(Auth::id());
        $userstaff = \DB::select("SELECT * FROM users WHERE role_id!='3' order by ID DESC ");






        $Cart = \DB::select('select * from cart WHERE User_Id=?', [$user->id]);

        foreach ($Cart as $c) {



            DB::table('transactions')->insert([
                ['USER_ID' => $c->User_Id, 'Product_ID' => $c->Product_Id, 'START_DATE' => $c->Start_Date, 'END_DATE' => $c->End_Date, 'BOOKING_STATUS' => 'pending', 'BOOKING_REASON' => $request->input('Reason'),'FULL_DAY'=>$c->Full_Day]
            ]);

            DB::table('cart')->where('Cart_Id', '=', $c->Cart_Id)->delete();
            DB::commit();

        }



        $admin='m.panda1@nuigalway.ie';


         $staffanduser= array();
         foreach($userstaff as $key => $staffarr)
         {
             if($staffarr->role_id!=1)
             {
                 array_push($staffanduser,$staffarr->email);
             }
             else
             {
                 $admin =$staffarr->email;
             }
             array_push($staffanduser,$staffarr->email);
         }

         array_push($staffanduser,$user->email);

         $data = array('name'=>$user->name,'reason'=>$request->input('Reason'),'cart'=>$Cart);
         // Path or name to the blade template to be rendered
         $template_path = 'Mail.mail';


         Mail::send($template_path, $data, function($message) use($admin,$staffanduser) {
             // Set the receiver and subject of the mail.
             $message->to($admin, "Admin")->subject('New Booking request');
             // Set the sender
             $message->from('a.ramaswamy1@nuigalway.ie','NUIGsocs Inventory Mail');
             $message->cc($staffanduser);
         });


        echo 1;
    }
}
