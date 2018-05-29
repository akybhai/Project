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
        else {
            $cat = \DB::table('categories')->select('category as c')->get();

            return view('Ajaxblade/catgrid')->with('cat', $cat);
        }

    }
}
