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
        $cartvalue = array();

        DB::table('cart')->where('Cart_Expiry_Time', '<', time())->delete();
        DB::commit();

        $Cart = \DB::select('select * from cart');


        foreach ($Cart as $c) {


            DB::table('cart')->where('Cart_Id', '=', $c->Cart_Id)->delete();

            DB::commit();


            $begin = new DateTime($c->Start_Date);
            $end = new DateTime($c->End_Date);
            $end = $end->modify('+1 day');

            $interval = new DateInterval('P1D');
            $daterange = new DatePeriod($begin, $interval, $end);

            foreach ($daterange as $date) {
                array_push($cartvalue, array($c->Product_Id, $c->User_Id, $date->format('y-m-d')));
            }
        }

        function custom_sort($a, $b)
        {
            // sort by last name
            $retval = strnatcmp($a[0], $b[0]);
            // if last names are identical, sort by first name
            if (!$retval) $retval = strnatcmp($a[2], $b[2]);
            return $retval;
        }

// sort alphabetically by firstname and lastname
        usort($cartvalue, __NAMESPACE__ . '\custom_sort');


        foreach ($cartvalue as $c) {

            $startdate = $c[2];
            $enddate = $c[2];

            $inCartAfter = \DB::select('select count(*) as c from cart WHERE DATE_ADD(END_DATE, INTERVAL 1 DAY)=? and Product_Id=? and User_Id=?', [$c[2], $c[0], $c[1]]);

            $inCartBefore = \DB::select('select count(*) as c from cart WHERE DATE_ADD(START_DATE, INTERVAL -1 DAY)=? and Product_Id=? and User_Id=?', [$c[2], $c[0], $c[1]]);


            if ($inCartAfter[0]->c == 1) {

                $START_DATE = DB::select('select Cart_Id,START_DATE from cart WHERE DATE_ADD(END_DATE, INTERVAL 1 DAY)=? and Product_Id=? and User_Id=?', [$c[2], $c[0], $c[1]]);

                DB::table('cart')->where('Cart_Id', '=', $START_DATE[0]->Cart_Id)->delete();

                DB::commit();

                $startdate = $START_DATE[0]->START_DATE;


            } else if ($inCartBefore[0]->c == 1) {

                $END_DATE = \DB::select('select Cart_Id,END_DATE from cart WHERE DATE_ADD(START_DATE, INTERVAL -1 DAY)=? and Product_Id=? and User_Id=?', [$c[2], $c[0], $c[1]]);

                DB::table('cart')->where('Cart_Id', '=', $END_DATE[0]->Cart_Id)->delete();
                DB::commit();

                $enddate = $END_DATE[0]->END_DATE;

            }

            DB::table('cart')->insert([
                ['Cart_Expiry_Time' => time() + 1800, 'Product_Id' => $c[0], 'User_Id' => $c[1], 'START_DATE' => $startdate, 'END_DATE' => $enddate]
            ]);
            DB::commit();


        }


        return view('cart/cart');
    }
}