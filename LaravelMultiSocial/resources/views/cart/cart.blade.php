@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="sa/css/bootstrap.css">
<!-- jQuery -->
<script src="sa/jquery/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="sa/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<style media="screen">
    .table>tbody>tr>td, .table>tfoot>tr>td{
        vertical-align: middle;
    }
    @media screen and (max-width: 600px) {
        table#cart tbody td .form-control{
            width:20%;
            display: inline !important;
        }
        .actions .btn{
            width:36%;
            margin:1.5em 0;
        }

        .actions .btn-info{
            float:left;
        }
        .actions .btn-danger{
            float:right;
        }

        table#cart thead { display: none; }
        table#cart tbody td { display: block; padding: .6rem; min-width:320px;}
        table#cart tbody tr td:first-child { background: #333; color: #fff; }
        table#cart tbody td:before {
            content: attr(data-th); font-weight: bold;
            display: inline-block; width: 8rem;
        }



        table#cart tfoot td{display:block; }
        table#cart tfoot td .btn{display:block;}

    }
</style>
<div class="container">

  <?php
  $userid= Auth::id();

  $cartcount = \DB::select('select count(*) as c from cart WHERE User_Id=?', [$userid]);

  ?>
  @if($cartcount[0]->c!=0)
    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:80%" class="text-center"><strong style="font-size: 25px;">Product</strong></th>
            <th style="width:20%" ></th>
        </tr>
        <tr>
        </thead>
        <tbody>
        <?php






        $Cart = \DB::select('select * from cart WHERE User_Id=?', [$userid]);



        foreach ($Cart as $c)
            {

                $prodcount=\DB::select('select count(*) as c from products WHERE productID=?', [$c->Product_Id]);

                $photocount=\DB::select('select count(*) as c from product_images WHERE product_id=?', [$c->Product_Id]);

                echo '<tr>
            <td data-th="Product">
                <div class="row">
                    <div class="col-sm-2 hidden-xs"><img src="/storage/cover_images/';


                    if($photocount[0]->c>0)
                        {
                            $photo=\DB::select('select cover_image as c from product_images WHERE product_id=?', [$c->Product_Id]);
                            echo $photo[0]->c;
                        }


                        else{
                        echo "/noPhoto.png";
        }



                    echo '" alt="..." class="img-responsive"/></div>
                    <div class="col-sm-10">
                        <h4 class="nomargin">';

                if($prodcount[0]->c>0)
                {
                    $prod=\DB::select('select name from products WHERE productID=?', [$c->Product_Id]);
                    echo $prod[0]->name;
                }


                else{
                    echo "No Name ";
                }























            echo '</h4>
                        <p> For Date '.


                    $c->Start_Date


                        .' to '.

                    $c->End_Date

                    .' </p>
                    </div>
                </div>
            </td>

            <td class="actions" align="middle">
                <button class="btn btn-danger btn-sm" onclick="DeleteandReload('.

                    $c->Cart_Id

                .')"><i class="fa fa-trash-o"></i></button>
            </td>
        </tr>


        ';
            }

            echo '<tr>
            <td align="center"><h4><b>Society/Group:</b></h4></td>
            <td><input style="float:right"  id ="society"></input>
            </tr>
            <tr>
            <td align="center"><h4><b>Reason for booking:</b></h4></td>
            <td><textarea rows="4" cols="50" style="float:right" placeholder="Event name, Location, No. of guests" id ="reason"></textarea>
            </td>
        </tr>';

        ?>
        </tbody>

        <tfoot>
        <tr>
            <td><a href="{{'/'}}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Add More Items</a></td>
            <td colspan="1"></td>
            <td><a href="#" class="btn btn-success btn-block" id="checkout" onclick="checkout()">Book <i class="fa fa-angle-right"></i></a></td>
        </tr>
        </tfoot>
    </table>
    @else
    <div style="height:400px;" class="span12">
Redirecting to Home page
</div>

    <script>
    alert("No Items in cart");

    setTimeout(function () {
       window.location.href = "{{'/'}}"; //will redirect to your blog page (an ex: blog.html)
    }, 500);
    </script>
    @endif
</div>


<div class="modal fade" id="myDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h4 class="modal-title" id="myDelModalLabel">Modal title</h4> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

      </div>
      <div class="modal-body">
        Are you sure you want to delete ?
      </div>
      <div class="modal-footer">


          <button class="btn btn-danger" onClick="submitform()" value="Delete">Delete</button>
      </div>
    </div>
  </div>
</div>
<!-- End Delete Modal -->
<script>



var active=1;

var idval=-1;

function submitform()
{
  $.ajax({
      type: "POST",

      url: '/deletefromcart',
      data: {'CartID':idval,_token: '{{csrf_token()}}'},
      success: function( msg ) {
          location.reload();
      }
  });
  $('#myDeleteModal').modal('hide');
}

    function DeleteandReload(id)
    {
      if(active)
      {
          idval=id;
          $('#myDeleteModal').modal('show');
      }
    }

    function checkout()
    {
      if(active)
      {
        active=0;

        var r=document.getElementById("reason").value;
        var s=document.getElementById("society").value;

        if(r=="" || s=="" )
        {
          alert("Enter all fields");
          active=1;
        }

        else{

          $("body").css("cursor", "wait");
            $.ajax({
                type: "POST",
                url: '/checkout',
                data: {'Reason':r,_token: '{{csrf_token()}}','Society':s},
                success: function( msg ) {
                    alert("Request Send To Admin");
                    window.location = "/";
                    $("body").css("cursor", "default");
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);

                }
            });
        }
    }
    }
    </script>


@endsection
@section('script')
@endsection
