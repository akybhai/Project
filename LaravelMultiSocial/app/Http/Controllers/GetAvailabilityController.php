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
    public function __invoke(Request $request)
    {

        DB::table('cart')->where('Cart_Expiry_Time', '<', time())->delete();
        DB::commit();

        $begin = new DateTime( $request->input("fromdate") );
        $end = new DateTime( $request->input("todate"));
        $end = $end->modify( '+1 day' );

        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval ,$end);



        echo '<div id="prod_'.$request->input("prodid").'" class="modal">

  <!-- Modal content -->
  <div class="modal-content ">
    <span id="span_'.$request->input("prodid").'" onclick="closemodal()" class="close">&times;</span>
     <p> Product ID '.$request->input("prodid").' </p>
     <div class="radio">
      <label><input type="checkbox" name="selectall" id="selectall" onclick="AllDateCheck()">Select All Available</label>
    </div>
     '
            .$request->input("fromdate")
            . ' '
            .$request->input("todate").'<br/>';

echo '<div class="panel panel-default">
                        <div class="panel-body table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Availability</th>
                                        <th>Selection </th>
                                    </tr>
                                </thead>
                                <tbody id="AvaTable">
                                    
                               ';
        foreach($daterange as $date){

            $inTran = \DB::select('select count(*) as c from transactions WHERE END_DATE>=? AND START_DATE<=? AND product_ID=? AND booking_status not in ("declined","returned")',
                [$date->format("Y-m-d"),$date->format("Y-m-d"),$request->input("prodid")]);


            if ($inTran[0]->c== 0)
            {

                $inCart = \DB::select('select count(*) as c from cart WHERE END_DATE>=? AND START_DATE<=? and product_ID=?',[$date->format("Y-m-d"),$date->format("Y-m-d"),$request->input("prodid")]);
                if ($inCart[0]->c== 0) {
                    echo ' <tr> <td>'.$date->format("Y-m-d").'</td>';
                      echo "<td> Avaliable</td>";
                      echo '<td><input type="checkbox" name='.$date->format("Y-m-d").' onclick="UpdateAllSelect()" value=""></td>';
                }
                else
                {
                    echo ' <tr> <td>'.$date->format("Y-m-d").'</td>';
                      echo "<td>Not Avaliable</td>";
                    echo '<td><input type="checkbox" value="" disabled></td>';
                }
            }
            else
            {
                echo ' <tr> <td>'.$date->format("Y-m-d").'</td>';
                echo "<td>Not Avaliable</td>";
                echo '<td><input type="checkbox" value="" disabled></td>';
            }

        }

           echo ' </tbody>
                            </table>
                        </div>
                    </div>


<button class="btn btn-primary" name="submit" type="submit" formaction="#" onclick="AddtoCart()">Add to cart</button> </div> </div> ';




    }
}