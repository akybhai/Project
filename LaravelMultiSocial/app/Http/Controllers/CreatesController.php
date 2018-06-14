<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // verifying login user
use App\User; // for login user verification

use Illuminate\Http\Request;
use App\Transaction;  //Defining the model
use DB;
use Mail;
use DateTime;

class CreatesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'checkstaffadmin']);

    }

    public function pendingdata()  // function to get all records having status pending
    {



        $articles = DB::table('transactions')
            ->leftJoin('products', 'transactions.product_id', '=', 'products.productID')
            ->leftJoin('users', 'transactions.user_id', '=', 'users.id')
            ->where('booking_status', 'pending')
            //->ON('booking_status','pending')
            ->select('transactions.*', 'products.name as productname', 'users.name as username', 'mobile')
            ->get();





        return view('staffadmin.pages.requests', ['articles' => $articles]); // passing to data to view home.blade.php
    }


    public function approvebutton($id, Request $request)
    {
        //Databasechanges
        DB:: table('transactions')->where('booking_id', $id)->update(['booking_status' => 'approved']);
        DB::table('transactions')->where('booking_id', $id)->update(['comment' => $request->input('comments')]);
        //return $id;
        //return redirect;
        return back();
    }

// Belwo function is for both approve and decline button in modal of pending page. Through switch case we are managing approve and decline

    public function approvedeclinebutton($id, Request $request)
    {

        $flag = 1;

        //to get username
        $articles = DB::table('transactions')
            ->select('transactions.*')->where('booking_id', $id)->get();

        switch ($request->input('action')) {
            case 'approve':

                if (new DateTime($articles[0]->start_date) <= new DateTime($request->input('startdate')) &&
                    new DateTime($articles[0]->end_date) >= new DateTime($request->input('enddate')) &&
                    new DateTime($request->input('startdate')) < new DateTime($request->input('enddate'))) {

                    DB:: table('transactions')->where('booking_id', $id)->update(['booking_status' => 'approved']);
                    DB::table('transactions')->where('booking_id', $id)->update(['comment' => $request->input('comment')]);
                    DB::table('transactions')->where('booking_id', $id)->update(['start_date' => $request->input('startdate')]);
                    DB::table('transactions')->where('booking_id', $id)->update(['end_date' => $request->input('enddate')]);


                }
                break;
            case 'decline':

                $flag = 0;
                DB:: table('transactions')->where('booking_id', $id)->update(['booking_status' => 'declined']);
                DB::table('transactions')->where('booking_id', $id)->update(['comment' => $request->input('comment')]);


                break;
        }


        $articles = DB::table('transactions')->leftJoin('products', 'transactions.product_id', '=', 'products.productID')
            ->leftJoin('users', 'transactions.user_id', '=', 'users.id')
            ->select('transactions.*', 'products.name as productname', 'users.name as username', 'mobile', 'email')->where('booking_id', $id)->get();


        $userstaff = \DB::select("SELECT * FROM users WHERE role_id!='3' order by ID DESC ");

        // trigger mail
        $admin = 'm.panda1@nuigalway.ie';
        if ($flag) {
            $subject = "Request Approved";
            $template_path = 'Mail.approvemail';
        } else {
            $subject = "Request Declined";
            $template_path = 'Mail.declinmail';
        }


        $staffandadmin = array();
        foreach ($userstaff as $key => $staffarr) {

            array_push($staffandadmin, $staffarr->email);


        }


        $email = $articles[0]->email;
        $name = $articles[0]->username;


        $data = array('array' => $articles);

        print_r($data);
        Mail::send($template_path, $data, function ($message) use ($email, $staffandadmin, $name, $subject) {
            // Set the receiver and subject of the mail.
            $message->to($email, $name)->subject($subject);
            // Set the sender
            $message->from('s.halyal1@nuigalway.ie', 'NUIGsocs Inventory Mail');
            $message->cc($staffandadmin);
        });

        // end of mail trigger
        return redirect('/admin/request');
    }


// ajax to handle approved data
    public function approvedData(Request $request)
    {
        if (request()->ajax()) {
            //  $articles= Transaction::where('booking_status','approved')->orWhere('booking_status','collected')->orWhere('booking_status','returned')->get();
            $articles = DB::table('transactions')
                ->leftJoin('products', 'transactions.product_id', '=', 'products.productID')
                ->leftJoin('users', 'transactions.user_id', '=', 'users.id')
                ->where('booking_status', 'approved')//->orWhere('booking_status','collected')->orWhere('booking_status','returned')
                ->select('transactions.*', 'products.name as productname', 'users.name as username', 'mobile')
                ->get();
            return view('staffadmin.ajax.approved', ['articles' => $articles]);
        }

    }


// ajax to handle declined Data data
    public function declinedData(Request $request)
    {
        if (request()->ajax()) {
            // $articles= Transaction::where('booking_status','declined')->get();
            //Transaction Product Productimage User
            //$transaction= Transaction::where('booking_status','declined')->get();
            //$product = Product::where('productID', $transaction->product_id)->first();
            //$productImage = ProductImages::where('product_id',$transaction->product_id);
            //$user = User::where('id', $transaction->user_id);
            //return view('staffadmin.ajax.declined',compact('transaction','product','productImage','user'))

            $articles = DB::table('transactions')
                ->leftJoin('products', 'transactions.product_id', '=', 'products.productID')
                ->leftJoin('users', 'transactions.user_id', '=', 'users.id')
                ->where('booking_status', 'declined')
                ->select('transactions.*', 'products.name as productname', 'users.name as username', 'mobile')->take(8)
                ->get();
            // print_r($articles);
            return view('staffadmin.ajax.declined', compact('articles'));
        }
        return back();

    }

    public function exportapproved(Request $request)// export approved functionality
    {
        $activities = DB::table('transactions')->select('user_id', 'product_id')->where('booking_status', 'approved')->orWhere('booking_status', 'collected')->orWhere('booking_status', 'returned')->orderBy('user_id', 'DESC')->get();
        $tot_record_found = 0;
        if (count($activities) > 0) {
            $tot_record_found = 1;
            //First Methos
            //$export_data="Timestamp,Events\n";
            $export_data = "user_id,product_id\n";
            foreach ($activities as $value) {
                $export_data .= $value->user_id . ',' . $value->product_id . "\n";
            }
            return response($export_data)
                ->header('Content-Type', 'application/csv')
                ->header('Content-Disposition', 'attachment; filename="Approved_download.csv"')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
            view('download', ['record_found' => $tot_record_found]);
        }
        return back();
    }

    public function exportdeclined(Request $request)// export declined functionality
    {
        $activities = DB::table('transactions')->select('user_id', 'product_id')->where('booking_status', 'declined')->orderBy('user_id', 'DESC')->get();
        $tot_record_found = 0;
        if (count($activities) > 0) {
            $tot_record_found = 1;
            //First Methos
            //$export_data="Timestamp,Events\n";
            $export_data = "user_id,product_id\n";
            foreach ($activities as $value) {
                $export_data .= $value->user_id . ',' . $value->product_id . "\n";
            }
            return response($export_data)
                ->header('Content-Type', 'application/csv')
                ->header('Content-Disposition', 'attachment; filename="Declined_download.csv"')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
            view('download', ['record_found' => $tot_record_found]);
        }

        return back();
    }


}
