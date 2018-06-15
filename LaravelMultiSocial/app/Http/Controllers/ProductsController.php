<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Category;
use App\ProductImages;
use App\product_documents;
use App\User;

use DB;
use Session;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkstaffadmin', ['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     // Page to display all or part of the product
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // controller to get the view to add/create product
    public function create()
    {
        $category = Category::all();
        return view('products.create')->with('category',$category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // controller to handle the request before adding product to the database
    public function store(Request $request)
    {
      // Validate
      $this->validate($request,[
        'productName' => 'required',
        'cover_image' => 'image|nullable|max:1999',
        'help_doc' => 'nullable|mimes:pdf|max:2048'
      ]);

	//check the uniqueness of the Product ID
      $prodIDCount = Product::where('productID', $request->input('productID'))
             ->count();
      // IF the productID is greater the zero implies non unique
      if($prodIDCount > 0)
      {
        Session::flash('warning',$request->input('productID').' Product ID already exists. Product cannot be added');
        return redirect()->route('adminstaff.products') ;
      }

      // Make an entry in the products_Cover Image table
      if($request->hasFile('cover_image'))
      {
        //get file name with extension
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        //get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //get just ext
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        //Filename to Store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //Upload image
        $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
      }
      else {
        $fileNameToStore = 'noimage.jpg';
      }

      $productImages = new productImages();
      $productImages->product_id =  $request->input('productID');
      $productImages->cover_image = $fileNameToStore;
      $productImages->save();

      // make entry in the documents page
      if($request->hasFile('help_doc'))
      {
        //get file name with extension
        $filenameWithExt = $request->file('help_doc')->getClientOriginalName();
        //get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //get just ext
        $extension = $request->file('help_doc')->getClientOriginalExtension();
        //Filename to Store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //Upload image
        $path = $request->file('help_doc')->storeAs('public/product_documents',$fileNameToStore);
      }
      else {
        $fileNameToStore = 'NoPdf.pdf';
      }
      $productDoc = new product_documents();
      $productDoc->product_id =  $request->input('productID');
      $productDoc->document_name = $fileNameToStore;
      $productDoc->save();




      // deal with the product category and change it to number
      $productCategoryId = Category::where('category',$request->input('productCategory'))->get();
      //add the new Entry in the products table
      $product = new Product();
      $product->name = $request->input('productName');
      $product->description = $request->input('productDescription');
      $product->category = $productCategoryId[0]->id;
      // net to think of mechanism to include the required item
      $product->productID = $request->input('productID');
      $product->save();


//save in log
      $prodid=$request->input('productID');
      $catname=$request->input('productCategory');
    //  $getData = DB::table('activities')->insert(array("event"=>"Product ($prodid) was added in category ($catname)"));
      $prod_name=DB::table('products')->where('productID',$prodid )->pluck('name');
      $user = User::find(Auth::id());
      $getData = DB::table('activity_logs')->insert(array("prod_user"=>"$prod_name[0]($prodid)", "action"=>"added", "performed_by"=>"$user->name", "cat_client"=>$catname));
      //redirect
      return redirect()->route('adminstaff.products') ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //return $id;
      $product = Product::find($id);
      $productImage = ProductImages::where('product_id', '=', $product->productID)->firstOrFail();
      return view('products.show', compact('product','productImage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::all();
        $product = Product::find($id);
        // categorySelected: is to find the category a particular product belongs to
        $categorySelected = Category::find($product->category)->category;
        return view('products.edit', compact('product','category', 'categorySelected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
     {
       $this->validate($request,[
         'productName' => 'required',
       ]);
       // Deal with images
       //Handle the File Upload
       if($request->hasFile('cover_image'))
       {
         //get file name with extension
           $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
           //get just filename
           $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
           //get just ext
           $extension = $request->file('cover_image')->getClientOriginalExtension();
           //Filename to Store
           $fileNameToStore = $filename.'_'.time().'.'.$extension;
           //Upload image
           $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
       }





       // deal with the product category and change it to number
       $productCategoryId = Category::where('category',$request->input('productCategory'))->get();
       //add

       $product = Product::find($id);
       //store the productID
       $productID = $product->productID;
       $product->name = $request->input('productName');
       $product->description = $request->input('productDescription');
       $product->category = $productCategoryId[0]->id;
       // net to think of mechanism to include the required item
       $product->save();

       #Update the product of the Image
       $productImage = ProductImages::where('product_id',$productID)->firstOrFail();
       // return $productImage;
       // handling product database
       // return 1;
       if($request->hasFile('cover_image'))
       {
         if($productImage->cover_image != 'noimage.jpg')
         {
         Storage::delete('public/cover_images/'.$productImage->cover_image);
         }
         $productImage->cover_image = $fileNameToStore;
       }
       $productImage->save();

       // Handle PDF file upload
       //Handle the File Upload
       if($request->hasFile('help_doc'))
       {
         //get file name with extension
           $filenameWithExt = $request->file('help_doc')->getClientOriginalName();
           //get just filename
           $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
           //get just ext
           $extension = $request->file('help_doc')->getClientOriginalExtension();
           //Filename to Store
           $fileNameToStore = $filename.'_'.time().'.'.$extension;
           //Upload image
           $path = $request->file('help_doc')->storeAs('public/product_documents',$fileNameToStore);
       }

       #Update the document of the product
       $productDoc = product_documents::where('product_id',$productID)->first();
       // return $productImage;
       // handling product database
       // return 1;

       if($request->hasFile('help_doc'))
       {
         if($productDoc->document_name != 'NoPdf.pdf')
         {
         Storage::delete('public/product_documents/'.$productDoc->document_name);
         }
         $productDoc->document_name = $fileNameToStore;
       }
       $productDoc->save();

       return redirect()->route('adminstaff.products') ;
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete Products
        $product = Product::find($id);
        $prod_id = $product->productID;
        $prod_name = $product->name;
        $category = DB::table('products')->where('productID',$product->productID )->pluck('name');

        $category=\DB::select('select category as c from  categories where id in (select category from products where productID=? )  ',[$product->productID]);

        $productImage = ProductImages::where('product_id',$product->productID)->first();
        $productDoc = product_documents::where('product_id',$product->productID)->first();
        $product->delete();

        if($productImage->cover_image != 'noimage.jpg')
        {
        Storage::delete('public/cover_images/'.$productImage->cover_image);
        }
        $productImage->delete();

        if($productDoc->document_name != 'NoPdf.pdf')
        {
        Storage::delete('public/product_documents/'.$productDoc->document_name);
        }
        $productDoc->delete();
        //save in log
    	//$prod_name=DB::table('products')->where('productID',$product->productID )->pluck('name');
        $user = User::find(Auth::id());
       $getData = DB::table('activity_logs')->insert(array("prod_user"=>"$prod_name($prod_id)", "action"=>"deleted", "performed_by"=>"$user->name", "cat_client"=>$category[0]->c));
        return redirect()->route('adminstaff.products') ;
    }
    /**
     * Function to export the list of all the products
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function exportProductCSV()
     {
         $products = Product::all();
         $tot_record_found=0;

         if(count($products)>0){
             $tot_record_found=1;
             //First Methos
             $export_data="ProductID,ProductName,Category\n";
             foreach($products as $value){
                 $export_data.=$value->productID.',' .$value->name.',' .$value->categories->category."\n";
             }
             return response($export_data)
                 ->header('Content-Type','application/csv')
                 ->header('Content-Disposition', 'attachment; filename="products_list_download.csv"')
                 ->header('Pragma','no-cache')
                 ->header('Expires','0');
                 view('download',['record_found' =>$tot_record_found]);
         }

         return back();
     }
}
