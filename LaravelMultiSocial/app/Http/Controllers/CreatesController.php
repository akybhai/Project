<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;  //Defining the model
use DB;

class CreatesController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware(['auth','checkstaffadmin']);
  }
  public function pendingdata()  // function to get all records having status pending
{
  #trying a single line comment
  //echo '<pre>';
  //$articles = Article::all(); // getting all the records using all()
  $articles = Transaction::where('booking_status', 'pending')->get();
  return $articles;
  //return $articles;
  // return $articles;
    return view('staffadmin.pages.requests')->with('articles',$articles);
  // return view('staffadmin.pages.requests', ['transactions' => $articles]); // passing to data to view home.blade.php
  //return view('pages.home')->with('articles',$articles);
  // ,['articles'=> $articles]
//  print_r($articles);
  //echo '</pre>';
}




public function approvebutton($id)
{
  //Databasechanges
  DB:: table('transactions')->where('booking_id',$id)->update(['booking_status'=>'approved']);
  //return $id;
  //return redirect;
  return back();
}
// ajax to handle approved data
public function approvedData(Request $request)
{
  if(request()->ajax())
  {
    $articles= Transaction::where('booking_status','approved')->orWhere('booking_status','collected')->orWhere('booking_status','returned')->get();
    return view('staffadmin.ajax.approved',['articles'=> $articles]);
  }

}
// ajax to handle declined Data data
public function declinedData(Request $request)
{
  if(request()->ajax())
  {
      $articles= Transaction::where('booking_status','declined')->get();
      return view('staffadmin.ajax.declined',['articles'=>$articles]);
  }

}

public function exportapproved(Request $request)// export approved functionality
  {
         $activities=DB::table('transactions')->select('user_id','product_id')->where('booking_status','approved')->orWhere('booking_status','collected')->orWhere('booking_status','returned')->orderBy('user_id', 'DESC')->get();
         $tot_record_found=0;
         if(count($activities)>0)
         {
             $tot_record_found=1;
             //First Methos
             //$export_data="Timestamp,Events\n";
              $export_data="user_id,product_id\n";
             foreach($activities as $value)
             {
                 $export_data.=$value->user_id.',' .$value->product_id."\n";
             }
             return response($export_data)
                 ->header('Content-Type','application/csv')
                 ->header('Content-Disposition', 'attachment; filename="Approved_download.csv"')
                 ->header('Pragma','no-cache')
                 ->header('Expires','0');
         }
         view('download',['record_found' =>$tot_record_found]);
     }

     public function exportdeclined(Request $request)// export declined functionality
     {
            $activities=DB::table('transactions')->select('user_id','product_id')->where('booking_status','declined')->orderBy('user_id', 'DESC')->get();
            $tot_record_found=0;
            if(count($activities)>0)
            {
                $tot_record_found=1;
                //First Methos
                //$export_data="Timestamp,Events\n";
                 $export_data="user_id,product_id\n";
                foreach($activities as $value)
                {
                    $export_data.=$value->user_id.',' .$value->product_id."\n";
                }
                return response($export_data)
                    ->header('Content-Type','application/csv')
                    ->header('Content-Disposition', 'attachment; filename="Declined_download.csv"')
                    ->header('Pragma','no-cache')
                    ->header('Expires','0');
            }
            view('download',['record_found' =>$tot_record_found]);
        }





}
