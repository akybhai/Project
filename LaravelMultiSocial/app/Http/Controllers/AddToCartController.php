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

use Illuminate\Support\Facades\Auth;
use App\User;
class AddToCartController extends Controller
{
    public function __invoke(Request $request)
    {

        $userid= Auth::id();


        foreach ($request->input('Dates') as $date) {

            $startdate=$date;
            $enddate=$date;


            $inCartAfter = \DB::select('select count(*) as c from cart WHERE DATE_ADD(End_Date, INTERVAL 1 DAY)=? and Product_ID=? and User_Id=?', [$date, $request->input("ProdId"), $userid]);

            $inCartBefore = \DB::select('select count(*) as c from cart WHERE DATE_ADD(Start_Date, INTERVAL -1 DAY)=? and Product_ID=? and User_Id=?', [$date, $request->input("ProdId"), $userid]);


            if ($inCartAfter[0]->c == 1) {

                $START_DATE = DB::select('select Cart_Id,START_DATE from cart WHERE DATE_ADD(End_Date, INTERVAL 1 DAY)=? and product_ID=? and User_Id=?', [$date, $request->input("ProdId"), $userid]);

                echo $START_DATE[0]->Cart_Id;
                DB::table('cart')->where('Cart_Id', '=', $START_DATE[0]->Cart_Id)->delete();

                DB::commit();

                $startdate=$START_DATE[0]->START_DATE;


            }
            else if ($inCartBefore[0]->c == 1)
            {

                $END_DATE =\DB::select('select Cart_Id,END_DATE from cart WHERE DATE_ADD(Start_Date, INTERVAL -1 DAY)=? and product_ID=? and User_Id=?', [$date, $request->input("ProdId"), $userid]);

                DB::table('cart')->where('Cart_Id', '=', $END_DATE[0]->Cart_Id)->delete();
                DB::commit();

                $enddate=$END_DATE[0]->END_DATE;

            }

                DB::table('cart')->insert([
                    ['Cart_Expiry_Time' => time()+1800, 'product_ID' => $request->input("ProdId"),'User_Id'=> $userid ,'START_DATE'=>$startdate,'END_DATE'=>$enddate]
                ]);
                DB::commit();
                echo 1;

        }
    }


}