<?php
/**
 * Created by PhpStorm.
 * User: sanjeev halyal
 * Date: 28-03-2018
 * Time: 15:46
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetCatController extends Controller
{
    public function __invoke(Request $request)
    {

        $cat = \DB::select('select count(*) as c from categories');

        if($cat[0]->c==0)
        {
            echo "No categories";
        }
        $cat = \DB::table('categories')->select('category as c')->get();


        foreach ($cat as $cc) {

//            echo '<li1>
//                        <input type="radio" id="' . 'cat_' . $cc->c . '" name="selector">
//                        <label for="' . 'cat_' . $cc->c . '">' . $cc->c . '</label>
//                        <div class="check"></div>
//                    </li1>';

            echo '<a class="list-group-item list-group-item-action" 
                id="' . 'cat_' . $cc->c . '" onclick="hone(\'' . 'cat_' . $cc->c . '\')" href="#" >
                '  . $cc->c . '
                </a>';
        }



    }
}
