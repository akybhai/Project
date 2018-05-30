<?php
/**
 * Created by PhpStorm.
 * User: sanjeev halyal
 * Date: 30-03-2018
 * Time: 13:32
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use DateTime,DateInterval,DatePeriod;

use Illuminate\Support\Facades\Auth;
use App\User;
class AddToCartController extends Controller
{
    public function multiday(Request $request)
    {

        $userid = Auth::id();


        foreach ($request->input('Dates') as $date) {

            $startdate = new DateTime($date);

            $enddate = new DateTime($date);


            echo $request->input("ProdId");
            echo $userid;
            echo "se \n";
            echo date_format($startdate, 'Y-m-d');
            echo date_format($enddate, 'Y-m-d');
            echo "se \n";


            $inCartAfter = \DB::select('select count(*) as c from cart WHERE DATE_ADD(DATE(End_Date), INTERVAL 1 DAY)=? and Product_ID=? and User_Id=? and Full_Day=1', [$date, $request->input("ProdId"), $userid]);
            $inCartBefore = \DB::select('select count(*) as c from cart WHERE DATE_ADD(DATE(Start_Date), INTERVAL -1 DAY)=? and Product_ID=? and User_Id=? and Full_Day=1', [$date, $request->input("ProdId"), $userid]);
//
//
            if ($inCartAfter[0]->c == 1) {

                $START_DATE = DB::select('select Cart_Id,START_DATE from cart WHERE DATE_ADD(DATE(End_Date), INTERVAL 1 DAY)=? and product_ID=? and User_Id=? and Full_Day=1', [$date, $request->input("ProdId"), $userid]);


                DB::table('cart')->where('Cart_Id', '=', $START_DATE[0]->Cart_Id)->delete();

                DB::commit();

                $startdate = $START_DATE[0]->START_DATE;


            } else if ($inCartBefore[0]->c == 1) {

                $END_DATE = \DB::select('select Cart_Id,END_DATE from cart WHERE DATE_ADD(DATE(Start_Date), INTERVAL -1 DAY)=? and product_ID=? and User_Id=? and Full_Day=1', [$date, $request->input("ProdId"), $userid]);

                DB::table('cart')->where('Cart_Id', '=', $END_DATE[0]->Cart_Id)->delete();
                DB::commit();

                $enddate = $END_DATE[0]->END_DATE;

            }

            $startinput = 0;
            $endinput = 0;

            if (gettype($startdate) == "string") {
                $datmodify = new DateTime($startdate);
                $startinput = date_format($datmodify, 'Y-m-d') . ' 00:00:00';
            } else {

                $startinput = date_format($startdate, 'Y-m-d');
                $startinput = $startinput . ' 00:00:00';
            }


            if (gettype($enddate) == "string") {
                $datmodify = new DateTime($enddate);
                $endinput = date_format($datmodify, 'Y-m-d') . ' 23:59:59';

            } else {

                $endinput = date_format($enddate, 'Y-m-d');

                $endinput = $endinput . ' 23:59:59';

            }


            echo $startinput;
            echo $endinput;

            echo 'INSERT INTO cart (Cart_Id, Cart_Expiry_Time, Product_Id, User_Id, Start_Date, End_Date) VALUES (NULL, '
                . (time() + 1800)
                . ', '
                . $request->input("ProdId")
                . ', ' . $userid
                . ', \'' . $startinput . '\'
                , \'' . $endinput . '\')';


            DB::statement('INSERT INTO cart (Cart_Id, Cart_Expiry_Time, Product_Id, User_Id, Start_Date, End_Date) VALUES (NULL, '
                . (time() + 1800)
                . ', '
                . $request->input("ProdId")
                . ', ' . $userid
                . ', \'' . $startinput . '\'
                , \'' . $endinput . '\')');

            DB::commit();
            echo 1;
        }
    }


        public function singleday(Request $request)
    {

        $userid= Auth::id();

        $datmodify=new DateTime( $request->input('Date') );
        $startinput=date_format($datmodify, 'Y-m-d')." ".$request->input('Fromtime');
        $endinput=date_format($datmodify, 'Y-m-d')." ".$request->input('Totime');



        DB::statement('INSERT INTO cart (Cart_Id, Cart_Expiry_Time, Product_Id, User_Id, Start_Date, End_Date,Full_day) VALUES (NULL, '
            .(time()+1800)
        .', '
        .$request->input("ProdId")
        .', '.$userid
        .', \''.$startinput.'\'
                , \''.$endinput.'\','.
        0
        .')');

        DB::commit();

                echo 1;
        }

        public function addtocart(Request $request)
        {

            $userid= Auth::id();

            $dates=explode(",", $request->input("Dates"));;

            $length = count($dates);
            for ($i = 0; $i < $length; $i=$i+2) {

                $startinput=$dates[$i];
                $endinput=$dates[$i+1];

                DB::statement('INSERT INTO cart (Cart_Id, Cart_Expiry_Time, Product_Id, User_Id, Start_Date, End_Date,Full_day) VALUES (NULL, '
                    .(time()+1800)
                    .', '
                    .$request->input("ProdId")
                    .', '.$userid
                    .', \''.$startinput.'\'
                , \''.$endinput.'\','.
                    0
                    .')');
                DB::commit();
            }

            echo 1;
        }




}