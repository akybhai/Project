<?php
/**
 * Created by PhpStorm.
 * User: sanjeev halyal
 * Date: 28-03-2018
 * Time: 21:07
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class GetProductController extends Controller
{
    public function __invoke(Request $request)
    {


        $cat= \DB::table('categories')->select('id')->where('category', 'like',$request->input('category') )->get();


        $pro = \DB::table('products')->select('name as n','description  as d','productID as p','category as c')->where('category',$cat[0]->id )->get();



        foreach ($pro as $key =>$pp)
        {


            echo '<tr>
                        <th scope="row">'.($key+1).'</th>
                        <td>'.$pp->n.'</td>
                        <td>'.$pp->d.'</td>
                        <td>'.$pp->p.'</td>
                        <td><button type="button" class="btn btn-primary" onclick="viewprod('.$pp->p.');">Availability</button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#product_view_'.$pp->p.'"><i class="fa fa-search"></i> Quick View</button>
                        </td>

                    </tr>
                    <div class="modal fade product_view" id="product_view_'.$pp->p.'">
   <div class="modal-dialog">
   <div class="modal-content">
       <div class="modal-header">
           <a href="#" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove"></span></a>
           <h3 class="modal-title">Product Description</h3>
       </div>
       <div class="modal-body">
           <div class="row">
               <div class="col-md-6 " style="overlay:auto;" >
                   <img  src="/storage/cover_images/';


            $prodcount=\DB::select('select count(*) as c from products WHERE productID=?', [$pp->p]);

            $photocount=\DB::select('select count(*) as c from product_images WHERE product_id=?', [$pp->p]);

            if($photocount[0]->c>0)
        {
            $photo=\DB::select('select cover_image as c from product_images WHERE product_id=?', [$pp->p]);
            echo $photo[0]->c;
        }


        else{
            echo "img/noPhoto.png";
        }


            echo '" class="img-responsive" style="height:300px;weight:100%">
               </div>
               <div class="col-md-6 product_content">
                   <h4>Product Id: <span>'.$pp->p.'</span></h4>
                   <h4>Product Name: <span>'.$pp->n.'</span></h4>
                   <p>'.$pp->n.'</p>

               </div>
           </div>
           <div class="modal-footer">
             <div class="btn-ground" align="middle">
                 <button type="button" data-dismiss="modal" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>Close</button>
             </div>
           </div>
       </div>
   </div>
   </div>
   </div>';

        }





        $pro = \DB::select('select count(*) as c from products where category=?',[$cat[0]->id]);

        if($pro[0]->c==0)
        {
            echo "No Products in Category";
        }


    }
}
