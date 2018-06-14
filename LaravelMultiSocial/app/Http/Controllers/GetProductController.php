<?php
/**
 * Created by PhpStorm.
 * User: sanjeev halyal
 * Date: 28-03-2018
 * Time: 21:07
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Product;
use App\ProductImages;


class GetProductController extends Controller
{
    public function productlist(Request $request)
    {
        if($request->input('category')!="ALL PRODUCTS") {
            $cat = \DB::table('categories')->select('id')->where('category', 'like', $request->input('category'))->get();
            $pro = \DB::select('select count(*) as c from products where category=?', [$cat[0]->id]);

            if ($pro[0]->c != 0) {


                $pro = \DB::table('products')->select('name as n', 'description  as d', 'productID as p', 'category as c')->where('category', $cat[0]->id)->get();

                foreach ($pro as $key => $pp) {
                    echo '<tr>
                <td>' . $pp->p . '</td>
                <td>' . $pp->n . '</td>
                <td><a href="#" data-toggle="modal" data-target="#product_view" onclick=\'proddescp('.$pp->p.');\'><button type="button" class="btn btn-primary">Product Details</button></a></td>
                <td><a href="#" data-toggle="modal" data-target="#multidaymodal" onclick=\'multiday('.$pp->p.');\'><button type="button" class="btn"  >Availability</button></a></td>
            </tr>';

                }
            }

        }
        else
            {

                $pro = \DB::select('select count(*) as c from products');

                if ($pro[0]->c != 0) {



                    $pro = \DB::table('products')->select('name as n', 'description  as d', 'productID as p', 'category as c')->get();


                    foreach ($pro as $key => $pp) {

                        echo '<tr>
                <td>' . $pp->p . '</td>
                <td>' . $pp->n . '</td>
                <td><a href="#" data-toggle="modal" data-target="#product_view" onclick=\'proddescp('.$pp->p.');\'><button type="button" class="btn btn-primary">Product Details</button></a></td>
                <td><a href="#" data-toggle="modal" data-target="#multidaymodal" onclick=\'multiday('.$pp->p.');\'><button type="button" class="btn"  >Availability</button></a></td>
            </tr>';




                    }

                }
              }
            }









    public function singleproduct(Request $request)
    {
        $prodID = $request->input("productID");
        $products = \DB::select('select * from  products where productID=?  ',[$prodID]);
        $productImg=0;

        $count=\DB::select('select count(*) as c from  product_images where product_id=?  ',[$prodID]);



        if($count)

            {

              $productImg=(\DB::select('select cover_image as c from  product_images where product_id=?  ',[$prodID]))[0]->c;

            }

            else
                {
                    $productImg="no.jpg";
                }
        return json_encode(array($products, $productImg));
    }
}
