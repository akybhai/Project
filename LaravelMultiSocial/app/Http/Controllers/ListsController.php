<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
Use DB;
use App\User;

class ListsController extends Controller
{
  public function makestaff($id)
  {
       DB:: table('users')->where('id',$id)->update(['role_id'=>'2']);
       $user = User::find(Auth::id());

       $name = DB::table('users')->where('id',$id )->pluck('name')[0];
       //save logs
       $getData = DB::table('activity_logs')->insert(array("prod_user"=>"$name($id)", "action"=>"promoted", "performed_by"=>"$user->name", "cat_client"=>"-"));
       return back();
  }

  public function deleteuser($id)

  {
    $user = User::find(Auth::id());

    $name = DB::table('users')->where('id',$id )->pluck('name')[0];
    //save logs

    DB:: table('users')->where('id',$id)->delete();
    $getData = DB::table('activity_logs')->insert(array("prod_user"=>"$name($id)", "action"=>"removed", "performed_by"=>"$user->name", "cat_client"=>"-"));
    //save logs
  //  $getData = DB::table('activities')->insert(array("event"=>"User ($id) was deleted"));
    return back();
      //session(0->flash('notify','User has been removed');
  }

  public function exportuserlist(Request $request)// export functionality
  {
         $activities=DB::table('users')->select('id','name')->get();
         $tot_record_found=0;
         if(count($activities)>0)
         {
             $tot_record_found=1;
             //First Methos
             //$export_data="Timestamp,Events\n";
              $export_data="id,name\n";
             foreach($activities as $value)
             {
                 $export_data.=$value->id.',' .$value->name."\n";
             }
             return response($export_data)
                 ->header('Content-Type','application/csv')
                 ->header('Content-Disposition', 'attachment; filename="Userlist_download.csv"')
                 ->header('Pragma','no-cache')
                 ->header('Expires','0');
         }
         view('download',['record_found' =>$tot_record_found]);
     }

}
