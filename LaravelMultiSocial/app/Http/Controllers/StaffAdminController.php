<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Category;
use DB;
use App\Product;
use App\ProductImages;
use App\Transaction;

class StaffAdminController extends Controller
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
  /**
   * Show the available categories and form to add category.
   *
   * @return \Illuminate\Http\Response
   */
   public function showCategories()
   {
     // Get a instance of category
     $cat = Category::all();
    return view('staffadmin.pages.categories')->with('cat',$cat);
   }

   /**
    * Add new Category to the database.
    *
    * @return \Illuminate\Http\Response
    */
    public function addNewCategories(Request $request)
    {
      // Get a instance of category
      $this->validate($request,[
        'category' => 'required',
      ]);
      $cat = new Category();
      $cat->category = $request->input('category');
      $cat->save();
      return redirect()->route('adminstaff.newcategories');
    }
    /**
     * Remove Category from the database.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyCategories($id)
    {
        //delete categories
        //here check wether the product  exist in that particular category then only delete the category
        $cat = Category::find($id);
        $cat->delete();

        return redirect()->route('adminstaff.newcategories');
    }

    //product collect form function
    function collect(Request $req){
        $req->validate([
            'prodID' => 'required|integer',
            'studID' => 'required|integer',
            'staff' => 'required'
        ]);

        $productID = $req->input('prodID');
        $collect_user_id = $req->input('studID');
        $bookingID = $req->input('bookID');
        $staff_inc = $req->input('staff');


        $data = array("collect_user_id"=>$collect_user_id, "staff_incharge_collect_name"=>$staff_inc, "booking_status"=>"collected", "product_id"=>"$productID");
        DB::table('transactions')->where('booking_id', $bookingID)->update($data);

        $prod_name=DB::table('products')->where('productID',$productID )->pluck('name');
    //    $staff_name = DB::table('users')->where('name',$staff_inc )->pluck('name');

        $getData = DB::table('activity_logs')->insert(array("prod_user"=>"$prod_name[0]($productID)", "action"=>"collected", "performed_by"=>"$staff_inc"));

    //   $getData = DB::table('activities')->insert(array("event"=>"Product ($productID) collected by User ($collect_user_id) from Staff ($staff_inc)"));
       return redirect()->route('home');
    }

    //product return form function
    function return(Request $req){

        $req->validate([
            'comment' => 'required',
            'staff' => 'required'
        ]);

        $comment = $req->input('comment');
        $staff_inch = $req->input('staff');
        $bookingID = $req->input('bookID');
        $productID = $req->input('prodID');
    //    echo $staff_inch;
        $data = array("staff_incharge_return_name"=>$staff_inch, "return_comment"=>$comment, 'return_date'=>date("Y-m-d"), "booking_status"=>"returned");
        DB::table('transactions')->where('booking_id', $bookingID)->update($data);

        $prod_name=DB::table('products')->where('productID',$productID )->pluck('name');
    //    $staff_name = DB::table('users')->where('id',$staff_inch )->pluck('name');

        $getData = DB::table('activity_logs')->insert(array("prod_user"=>"$prod_name[0]($productID)", "action"=>"returned", "performed_by"=>"$staff_inch"));
        return redirect()->route('home');
    }

    //function for logs.blade.php
    public function showLogs()
    {
     $activity = DB::table('activity_logs')->orderBy('event_timestamp', 'DESC')->get();
     return view('staffadmin.pages.logs', compact('activity'));
    }

    //export to excel logs
    public function export(Request $request){
        $activities=DB::table('activity_logs')->select('event_timestamp','prod_user','action','performed_by')->orderBy('event_timestamp', 'DESC')->get();
        $tot_record_found=0;
        if(count($activities)>0){
            $tot_record_found=1;
            //First Methos
            $export_data="Timestamp,Product/User, ,Action,Incharge\n";
            foreach($activities as $value){
                $export_data.=$value->event_timestamp.',' .$value->prod_user.',' .' '.','.$value->action.',' .$value->performed_by."\n";
            }
            return response($export_data)
                ->header('Content-Type','application/csv')
                ->header('Content-Disposition', 'attachment; filename="activity_logs_download.csv"')
                ->header('Pragma','no-cache')
                ->header('Expires','0');
        }
        view('download',['record_found' =>$tot_record_found]);
    }

    public function showuserlist()
    {
     return view('staffadmin.pages.userlist' );
    }
    /**
     * Show the products page.
     * consideration that all the Product will be stored with the image
     * @return \Illuminate\Http\Response
     */
     public function showProducts(Request $request)
     {
       // Get a instance of category
      $cat = Category::all();
      // check if the request is AJAX
      if(request()->ajax() and $request->has('categoryId'))
      {
        $cat_id = $request->categoryId;
        $products = Product::where('category', $cat_id)
              //  ->orderBy('name', 'desc')
              //  ->take(10)
               ->get();

        //single product
        // $prod = Product::find(2);
        // return $prod->productID;
        // $productImg = Product::find(2)->ProductImages->where('product_id', $prod->productID)->first()->cover_image;
        // ->where('product_id', $prod->productID)->cover_image->;
        // $productImg = $prod->ProductImages()->where('product_id', $prod->productID)->firstOrFail();
        // ()->where('product_id',$prod->productID)->first();
        // return $productImg;
        // return $products;
        // $productImage = ProductImages::where('product_id', '=', $product->productID)->firstOrFail();
        return view('staffadmin.ajax.productTable', compact('products'));
      }
      if(request()->ajax() and $request->has('productID'))
      {
        $prodID = $request->productID;
        $products = Product::find($prodID);
        $productImg = $products->ProductImages->where('product_id', $products->productID)->first();
        // ->first()->cover_image;
        // $prod->ProductImages->where('product_id', $prod->productID)->first()->cover_image

        // ->where('product_id', $request->productID)->first()->cover_image;
        // ->where('product_id', $prod->productID)->first()->cover_image;
        return json_encode(array($products, $productImg));
      }
      return view('staffadmin.pages.Product')->with('cat', $cat);
     }

     public function editProduct(Request $request)
     {

       $category = Category::all();
       if(request()->ajax() and $request->has('productID'))
       {
         $product = Product::find($request->productID);
         $categorySelected = Category::find($product->category)->category;
         return json_encode(array($product, $categorySelected));
       }

         $product = Product::find($id);
         // categorySelected: is to find the category a particular product belongs to
         $categorySelected = Category::find($product->category)->category;
         return view('products.edit', compact('product','category', 'categorySelected'));
     }

       //manmaya's
        public function pendingdata()  // function to get all records having status pending
        {
        #trying a single line comment
        //echo '<pre>';
        //$articles = Article::all(); // getting all the records using all()
         $articles = Transaction::where('booking_status','pending')->get();
        //return Transaction::all();
        //return $articles;  // return $articles;
          return view('staffadmin.pages.requests')->with('articles',$articles);
          //$products= Product::whereIn('id','$articles')->get();
        // return view('staffadmin.pages.requests', ['transactions' => $articles]); // passing to data to view home.blade.php
        //return view('pages.home')->with('articles',$articles);
        // ,['articles'=> $articles]
        //  print_r($articles);
        //echo '</pre>';
        }
        public function userlist()  // show userlist
        {
          $userlists = User::all();
          return view('staffadmin.pages.userlist',['userlists' => $userlists]);
        }


        public function singleproductdashboard(Request $request)
        {
            $prodID = $request->productID;
            $products= \DB::select('select * from products WHERE productID=?',[$prodID]);
            $productImg=0;



            $tranID=$request->tran_ID;
//            echo $tranID;
            $inTran = \DB::select('select * from transactions WHERE booking_id=?',[$tranID]);

            $users = \DB::select('select * from users WHERE id=?',[$inTran[0]->user_id]);



            $im=\DB::select('select cover_image as c from  product_images where product_id=?  ',[$prodID]);



            if(count($im)==0)

                {

                    $productImg="no.jpg";


                }

                else
                    {

                        $productImg=$im[0]->c;
                    }
//            echo $products[0]->productID;
// echo $productImg[0]->cover_image;
// echo $products[0]->name;
// echo $inTran[0]->start_date;
// echo $inTran[0]->end_date;
// echo $users[0]->name;
// echo $inTran[0]->booking_reason;
//            return json_encode(array($products[0]->productID, $productImg[0]->cover_image,$products[0]->name,$inTran[0]->start_date,$inTran[0]->end_date,$users[0]->name,$inTran[0]->booking_reason));
            return json_encode(array($products, $productImg,$inTran,$users));

        }

}
