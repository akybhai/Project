<?php
/**
 * Created by PhpStorm.
 * User: sanjeev halyal
 * Date: 29-03-2018
 * Time: 11:27
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use DateTime,DateInterval,DatePeriod;
class GetAvailabilityController extends Controller
{



    public function ava(Request $request)
    {




        $datepoints=GetAvailabilityController::avathatday($request);


//logic for most avaliable products



$prodname=(\DB::select('select name as a from products b WHERE productID=? ',[$request->input("prodid")]));

$inTran = \DB::select('select name as a,productID as b from products WHERE name like "%'.$prodname[0]->a.'%" and productID<>? ',
[$request->input("prodid")]);


$mostava=$request->input("prodid");
$avanumber=GetAvailabilityController::avanumber($request,$request->input("prodid"));
for($t=0;$t< count($inTran); $t++ )
{
    $avareturn=GetAvailabilityController::avanumber($request,$inTran[$t]->b);
    if($avanumber<$avareturn)
    {
      $avanumber=$avareturn;
      $mostava=$inTran[$t]->b;
    }
}

if($mostava==$request->input("prodid"))
{
$mostava=0;
}


        // echo json_encode([$datepoints,$inTran]);

        echo json_encode([$datepoints,$mostava]);

    }












    public static  function avathatday(Request $request)
    {
      DB::table('cart')->where('Cart_Expiry_Time', '<', time())->delete();
      DB::commit();

      $fromdate = new DateTime($request->input("fromdate"));
      $todate = new DateTime($request->input("todate"));
      $fromtime = $request->input("fromtime") . ':00';
      $totime = $request->input("totime") . ':00';


      $fromdatetime = $fromdate->format("Y-m-d") . " " . $fromtime;
      $todatetime = $todate->format("Y-m-d") . " " . $totime;

      $inTran = \DB::select('select START_DATE as a,END_DATE as b from transactions WHERE

  (
  (END_DATE>=? AND END_DATE<=?)
  OR
  (START_DATE>=? AND START_DATE<=?)
  )
  AND
  product_ID=?

  AND booking_status not in ("declined","returned") order by END_DATE',
          [$fromdatetime, $todatetime, $fromdatetime, $todatetime, $request->input("prodid")]);

      $inCart = \DB::select('select START_DATE as a,END_DATE as b from cart WHERE

  (
  (END_DATE>=? AND END_DATE<=?)
  OR
  (START_DATE>=? AND START_DATE<=?)
  )
  AND
  product_ID=?

  order by END_DATE',
          [$fromdatetime, $todatetime, $fromdatetime, $todatetime, $request->input("prodid")]);

      $arr = [];

      foreach ($inTran as $iT) {
          array_push($arr, [$iT->a, $iT->b]);
      }

      foreach ($inCart as $iC) {
          array_push($arr, [$iC->a, $iC->b]);
      }

  //        echo json_encode($arr) . "\n";

      usort($arr, function ($a, $b) {
          $d1 = new DateTime($a[1]);
          $d2 = new DateTime($b[1]);
          return ($d1 < $d2) ? -1 : 1;
      });

  //        echo json_encode($arr) . "\n";

      $datepoints = [];

      if(count($arr)!=0) {

          if (!(new DateTime($fromdatetime) >= new DateTime($arr[0][0]) && new DateTime($fromdatetime) <= new DateTime($arr[0][1]))) {
              array_push($datepoints, $fromdatetime);
          }


          if (!(new DateTime($todatetime) >= new DateTime($arr[count($arr) - 1][0]) && new DateTime($todatetime) <= new DateTime($arr[count($arr) - 1][1]))) {
              array_push($datepoints, $todatetime);
          }

          foreach ($arr as $dp) {
              if ((new DateTime($dp[0]) > new DateTime($fromdatetime) && new DateTime($dp[0]) < new DateTime($todatetime))) {
                  $datetime = new DateTime($dp[0]);
                  $datetime = $datetime->modify('-1 minute');
                  array_push($datepoints, $datetime->format('Y-m-d H:i:s'));
              }

              if ((new DateTime($dp[1]) > new DateTime($fromdatetime) && new DateTime($dp[1]) < new DateTime($todatetime))) {
                  $datetime = new DateTime($dp[1]);
                  $datetime = $datetime->modify('+1 minute');
                  array_push($datepoints, $datetime->format('Y-m-d H:i:s'));
              }
          }


          usort($datepoints, function ($a, $b) {
              $d1 = new DateTime($a);
              $d2 = new DateTime($b);
              return ($d1 < $d2) ? -1 : 1;
          });


      }
      else
          {
              array_push($datepoints, $fromdatetime);
              array_push($datepoints, $todatetime);
          }

      $arr=[];
      for($x=0;$x<count($datepoints);$x=$x+2)
      {
          if( strtotime($datepoints[$x+1])-strtotime($datepoints[$x])>900)
          {
              array_push($arr,$datepoints[$x]);
              array_push($arr,$datepoints[$x+1]);
          }
      }

      return $arr;

    }

    public function avanumber(Request $request, $prodID)
    {

      DB::table('cart')->where('Cart_Expiry_Time', '<', time())->delete();
      DB::commit();

      $fromdate = new DateTime($request->input("fromdate"));
      $todate = new DateTime($request->input("todate"));
      $fromtime = $request->input("fromtime") . ':00';
      $totime = $request->input("totime") . ':00';


      $fromdatetime = $fromdate->format("Y-m-d") . " " . $fromtime;
      $todatetime = $todate->format("Y-m-d") . " " . $totime;

      $inTran = \DB::select('select START_DATE as a,END_DATE as b from transactions WHERE

      (
      (END_DATE>=? AND END_DATE<=?)
      OR
      (START_DATE>=? AND START_DATE<=?)
      )
      AND
      product_ID=?

      AND booking_status not in ("declined","returned") order by END_DATE',
          [$fromdatetime, $todatetime, $fromdatetime, $todatetime, $prodID]);

      $inCart = \DB::select('select START_DATE as a,END_DATE as b from cart WHERE

      (
      (END_DATE>=? AND END_DATE<=?)
      OR
      (START_DATE>=? AND START_DATE<=?)
      )
      AND
      product_ID=?

      order by END_DATE',
          [$fromdatetime, $todatetime, $fromdatetime, $todatetime, $prodID]);

      $arr = [];

      foreach ($inTran as $iT) {
          array_push($arr, [$iT->a, $iT->b]);
      }

      foreach ($inCart as $iC) {
          array_push($arr, [$iC->a, $iC->b]);
      }

      //        echo json_encode($arr) . "\n";

      usort($arr, function ($a, $b) {
          $d1 = new DateTime($a[1]);
          $d2 = new DateTime($b[1]);
          return ($d1 < $d2) ? -1 : 1;
      });

      //        echo json_encode($arr) . "\n";

      $datepoints = [];

      if(count($arr)!=0) {

          if (!(new DateTime($fromdatetime) >= new DateTime($arr[0][0]) && new DateTime($fromdatetime) <= new DateTime($arr[0][1]))) {
              array_push($datepoints, $fromdatetime);
          }


          if (!(new DateTime($todatetime) >= new DateTime($arr[count($arr) - 1][0]) && new DateTime($todatetime) <= new DateTime($arr[count($arr) - 1][1]))) {
              array_push($datepoints, $todatetime);
          }

          foreach ($arr as $dp) {
              if ((new DateTime($dp[0]) > new DateTime($fromdatetime) && new DateTime($dp[0]) < new DateTime($todatetime))) {
                  $datetime = new DateTime($dp[0]);
                  $datetime = $datetime->modify('-1 minute');
                  array_push($datepoints, $datetime->format('Y-m-d H:i:s'));
              }

              if ((new DateTime($dp[1]) > new DateTime($fromdatetime) && new DateTime($dp[1]) < new DateTime($todatetime))) {
                  $datetime = new DateTime($dp[1]);
                  $datetime = $datetime->modify('+1 minute');
                  array_push($datepoints, $datetime->format('Y-m-d H:i:s'));
              }
          }


          usort($datepoints, function ($a, $b) {
              $d1 = new DateTime($a);
              $d2 = new DateTime($b);
              return ($d1 < $d2) ? -1 : 1;
          });


      }
      else
          {
              array_push($datepoints, $fromdatetime);
              array_push($datepoints, $todatetime);
          }

      $arr=[];
      for($x=0;$x<count($datepoints);$x=$x+2)
      {
          if( strtotime($datepoints[$x+1])-strtotime($datepoints[$x])>900)
          {
              array_push($arr,$datepoints[$x]);
              array_push($arr,$datepoints[$x+1]);
          }
      }

      $number=0;

      for($x=0;$x<count($datepoints);$x=$x+2)
      {
        $diff = (new DateTime($datepoints[$x]))->diff(new DateTime($datepoints[$x+1]));

        $number=$number+$diff->days;
      }

      return $number;
    }
}
